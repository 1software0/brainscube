$('#tienda').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_tienda').removeClass('alert-danger');
  $('#ajax_tienda').removeClass('alert-warning');
  $('#ajax_tienda').addClass('alert-warning');
  $("#ajax_tienda").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_tienda').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/tienda",
    data : $('#tienda_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_tienda').html(success_icon + obj.message);
        $("#ajax_tienda").removeClass('alert-warning');
        $("#ajax_tienda").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_tienda').html(error_icon  + obj.message);
        $("#ajax_tienda").removeClass('alert-warning');
        $("#ajax_tienda").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#tienda ERORR');
    }
  });
});
