$(document).ready(function() {

  $('select[name="subject"]').change(function() {
    if ( $(this).val() == "contact") {
      $('#meeting').show("slow");
    }
    else {
      $('#meeting').hide("slow");
    }
  });

  $('input, textarea').click(function() {
    if ($(this).parents('.form-group').hasClass('has-warning')) {
      $(this).parents('.form-group').removeClass('has-warning').find('.help-block').addClass('animated fadeOutUp').hide("slow");
    }
  });

  $('#password').keyup(function() {
    var pass = $(this).val();
    if (/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])([A-Za-z0-9]{6,})$/.test(pass)) {
      $('.passwordLevel>span:first').css('background', '#30b828');
      $('.passwordLevel>span:nth-of-type(2)').css('background', '#30b828');
      $('.passwordLevel>span:last').css('background', '#30b828');
    } else if (/^((?=.*[A-Z])(?=.*[a-z])([A-Za-z]{6,})|(?=.*[A-Z])(?=.*[0-9])([A-Z0-9]{6,})|(?=.*[0-9])(?=.*[a-z])([0-9a-z]{6,}))$/.test(pass)) {
      $('.passwordLevel>span:first').css('background', '#ff8200');
      $('.passwordLevel>span:nth-of-type(2)').css('background', '#ff8200');
      $('.passwordLevel>span:last').css('background', '#C9C9C9');
    }else if (/^(([A-Z]{6,})|([a-z]{6,})|([0-9]){6,})$/.test(pass)) {
      $('.passwordLevel>span:first').css('background', '#FF0000');
      $('.passwordLevel>span:nth-of-type(2)').css('background', '#C9C9C9');
      $('.passwordLevel>span:last').css('background', '#C9C9C9');
    } else {
      $('.passwordLevel>span').css('background', '#C9C9C9');
    }
  });

  /*
  * Jquery SlimScroll
  */
  $('#slimScrollDiv').slimScroll({
    height: '250px'
  });

  $('#slimScrollDiv2').slimScroll({
    height: '100px'
  });

  $('#slimScrollDiv3').slimScroll({
    height: '80px'
  });

/*
 * Date picker
 */
  $('#activatedAt').datepicker({
       format: 'dd/mm/yyyy',
       startDate: 'd'
   });

   $('#birthDate').datepicker({
        format: 'dd/mm/yyyy'
    });

/*
 * Jquery Mask Plugin
 */
    $('#phone').mask('00.00.00.00.00');
    // $('#cardNumber').mask('0000.0000.0000.0000');


});
