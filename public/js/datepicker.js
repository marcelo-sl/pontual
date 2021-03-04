var mainUrl = window.location.origin;
var completeUrl = window.location.href;

$(document).ready(function() {
  function getUrlParams() {
    let urlParams = {
      classParam: completeUrl.split('/')[3],
      id: completeUrl.split('/')[4]
    };

    return urlParams;
  }

  function getDaysOfWeekDisabled() {
    let { classParam, id } = getUrlParams();
    let complementUrl = '/' + classParam + '/' + id + '/getDaysOfWeekDisabled';

    $.get({
      url: complementUrl,
      success: function (data) {
        $('#datepicker').datepicker('setDaysOfWeekDisabled', data);
      }
    });
  }
    
  getDaysOfWeekDisabled();

  $('#datepicker').datepicker({
    language: "pt-BR",
    todayHighlight: true,
    startDate: "0d",
    endDate: "+30d",
  }); 

  $('#datepicker').datepicker().on('changeDate', function(e) {
    // `e` here contains the extra attributes
    
    let date = new Date(e.date);
    let dateFormatted = `${date.getDate()}-${(date.getMonth() + 1)}-${date.getFullYear()}`;

    let { classParam, id } = getUrlParams();
    let complementUrl = '/' + classParam + '/' + id + '/getAvailableHours/' + dateFormatted;
    
    $.get(complementUrl, function (data) {
      let workingHours = JSON.parse(data);
      let hoursHTML = formatHours(workingHours);
      // console.log(workingHours);
      $('#working-hours-group').html(hoursHTML);
      
    });

    
    $('#schedule-date').val(dateFormatted);
  });
});



function formatHours(workingHours) {
  hourOption = '';
  
  workingHours.forEach(({hour, available}, i) => {
    if (available) {
      hourOption += `<label id="option" class="btn btn-outline-primary col-md-2 m-1 option">
        <input type="radio" id="option" class="option" name="options" value="${hour}" onchange="changeHour(this.value)">
        ${hour}
      </label>`;
    } else {
      hourOption += `<label class="btn btn-outline-secondary col-md-2 m-1 disabled" disabled>
        <input type="radio" class="option-hour" name="options" value="${hour}">
        ${hour}
      </label>`;
    }    
  });

  return hourOption;
}

function changeHour(e) {
  $('#schedule-hour').val(e);
  $('#schedule-submit').prop('disabled', false);
};