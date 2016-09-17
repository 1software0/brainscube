$('#review').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_review').removeClass('alert-danger');
  $('#ajax_review').removeClass('alert-warning');
  $('#ajax_review').addClass('alert-warning');
  $("#ajax_review").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_review').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/review",
    data : $('#review_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_review').html(success_icon + obj.message);
        $("#ajax_review").removeClass('alert-warning');
        $("#ajax_review").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_review').html(error_icon  + obj.message);
        $("#ajax_review").removeClass('alert-warning');
        $("#ajax_review").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#review ERORR');
    }
  });
});
