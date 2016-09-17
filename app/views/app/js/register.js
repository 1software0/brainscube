var ck = false;
$('#tyc_reg').change(function () {
  if (ck) {
    ck = false;
  } else {
    ck = true;
  }
});
$('#register').click(function (){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

if (!ck) {
  $('#ajax_register').removeClass('alert-warning');
  $('#ajax_register').removeClass('alert-warning');
  $('#ajax_register').addClass('alert-danger');
  $("#ajax_register").html(error_icon  + 'Debe aceptar los terminos y condiciones');
  $('#ajax_register').removeClass('hide');
} else {
  data = $('#register_form').serialize();
  $('#ajax_register').removeClass('alert-danger');
  $('#ajax_register').removeClass('alert-warning');
  $('#ajax_register').addClass('alert-warning');
  $("#ajax_register").html(process_icon  + 'Procesando información, por favor espere...');
  $('#ajax_register').removeClass('hide');
  $(':input').prop( "disabled", true );

  $.ajax({
    type : "POST",
    url : "api/register",
    data : data,
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_register').html(success_icon + obj.message);
        $("#ajax_register").removeClass('alert-warning');
        $("#ajax_register").addClass('alert-success');
        $(':input').val( "" );
        $(':input').prop( "disabled", false );
      } else {
        $('#ajax_register').html(error_icon  + obj.message);
        $("#ajax_register").removeClass('alert-warning');
        $("#ajax_register").addClass('alert-danger');
        $(':input').prop( "disabled", false );
      }
    },
    error : function() {
      window.alert('#register ERORR');
      $('#ajax_register').addClass('hide');
    }
  });
}
});
