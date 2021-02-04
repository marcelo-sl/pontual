$(document).on('change', '#hasBreakTime', function() {
  let hasBreakTime = $(this).is(':checked');

  if (!hasBreakTime) {
    $(".break-time-content").hide();
    return;
  }
    
  $(".break-time-content").show();

});

$(document).on('change', '#isClosed', function() {
  let isClosed = $(this).is(':checked');
  let weekDay = $(this).closest( ".week-days" );

  if (!isClosed) {
    weekDay.find('.working-hour').css('display', 'inline-flex');
    return;
  }
  
  weekDay.find('.working-hour').hide();

});