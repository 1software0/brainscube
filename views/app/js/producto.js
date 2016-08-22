var captchaContainer = null;
var robot = true;
var loadCaptcha = function() {
  captchaContainer = grecaptcha.render('captcha_container', {
    'sitekey' : '6LfI_iQTAAAAAJiCH92GTeswRhVkapOwMiVwO3mB',
    'callback' : function(response) {
      $("#res").val(response);
      robot = false;
    }
  });
};
$("#button-review").click(function () {

    var error_icon = '<span class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></span> ',
        success_icon = '<span class="a fa-check fa-lg" aria-hidden="true"></span> ',
        process_icon = '<span class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></span> ',
        ser = $('#form_review').serialize();

    $('#ajax_review').removeClass('alert-danger');
    $('#ajax_review').removeClass('alert-warning');
    $('#ajax_review').addClass('alert-warning');
    $("#ajax_review").html(process_icon  + 'Procesando pedido...');
    $('#ajax_review').removeClass('hide');
    $(":input").prop('disabled', true);
    $("#button-review").prop('disabled', true);
if (!robot) {
  $.ajax({
    type : "POST",
    url : "api/review",
    data : ser,
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_review').html(success_icon + obj.message);
        $("#ajax_review").removeClass('alert-warning');
        $("#ajax_review").addClass('alert-success');
        $(":input").prop('disabled', false);
        $(":input").val("");
        $("#button-review").prop('disabled', false);
        setTimeout(function(){
          location.reload();
        },100);
      } else {
        $('#ajax_review').html(error_icon  + obj.message);
        $("#ajax_review").removeClass('alert-warning');
        $("#ajax_review").addClass('alert-danger');
        $(":input").prop('disabled', false);
        $("#button-review").prop('disabled', false);
      }
    },
    error : function() {
      window.alert('#login ERORR');
      $('#ajax_review').addClass('hide');
      $(":input").prop('disabled', false);
      $("#button-review").prop('disabled', false);
    }
  });
} else {
  $('#ajax_review').html(error_icon  + 'Debe verificar que no sea un robot.');
  $("#ajax_review").removeClass('alert-warning');
  $("#ajax_review").addClass('alert-danger');
  $(":input").prop('disabled', false);
  $("#button-review").prop('disabled', false);
}

});
