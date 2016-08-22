$('#login').click(function (){

  var error_icon = '<i class="fa fa-check" aria-hidden="true"></i> ',
      success_icon = '<span class="a fa-check fa-lg" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin fa-lg" aria-hidden="true"></span> ';

  $('#ajax_login').removeClass('alert-danger');
  $('#ajax_login').removeClass('alert-warning');
  $('#ajax_login').addClass('alert-warning');
  $("#ajax_login").html(process_icon  + 'Iniciando sesión, por favor espere...');
  $('#ajax_login').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/login",
    data : $('#login_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_login').html(success_icon + obj.message);
        $("#ajax_login").removeClass('alert-warning');
        $("#ajax_login").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },100);
      } else {
        $('#ajax_login').html(error_icon  + obj.message);
        $("#ajax_login").removeClass('alert-warning');
        $("#ajax_login").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#login ERORR');
      $('#ajax_login').addClass('hide');
    }
  });
});
// facebook login

window.fbAsyncInit = function() {
    FB.init({
      appId      : '148761148889341',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
