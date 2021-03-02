var mainUrl = window.location.origin;
var completeUrl = window.location.href;

$(document).ready(function() {
  var daysOfWeekDisabled = [];

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
});