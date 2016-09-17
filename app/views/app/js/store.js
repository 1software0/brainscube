$('#store').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_store').removeClass('alert-danger');
  $('#ajax_store').removeClass('alert-warning');
  $('#ajax_store').addClass('alert-warning');
  $("#ajax_store").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_store').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/store",
    data : $('#store_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_store').html(success_icon + obj.message);
        $("#ajax_store").removeClass('alert-warning');
        $("#ajax_store").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_store').html(error_icon  + obj.message);
        $("#ajax_store").removeClass('alert-warning');
        $("#ajax_store").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#store ERORR');
    }
  });
});
