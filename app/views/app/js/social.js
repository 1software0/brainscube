$('#social').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_social').removeClass('alert-danger');
  $('#ajax_social').removeClass('alert-warning');
  $('#ajax_social').addClass('alert-warning');
  $("#ajax_social").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_social').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/social",
    data : $('#social_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_social').html(success_icon + obj.message);
        $("#ajax_social").removeClass('alert-warning');
        $("#ajax_social").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_social').html(error_icon  + obj.message);
        $("#ajax_social").removeClass('alert-warning');
        $("#ajax_social").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#social ERORR');
    }
  });
});
