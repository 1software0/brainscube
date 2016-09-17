function __($id) {
  return document.getElementById($id);
}

function Inicio_session() {
    var connect, form, response, result, user, pass, sesion;
    user = __('user_login').value;
    pass = __('pass_login').value;
    sesion = __('session_login').checked ? true : false;
    form = 'user=' + user + '&pass=' + pass + '&sesion=' + sesion;
    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    connect.onreadystatechange = function() {
      if(connect.readyState == 4 && connect.status == 200) {
        if(connect.responseText == 1) {
          result = '<div class="alert alert-dismissible alert-success">';
          result += '<h4>Conectado!</h4>';
          result += '<p><strong>Estamos redireccionandote...</strong></p>';
          result += '</div>';
          __('_AJAX_LOGIN_').innerHTML = result;
          location.reload();
        } else {
          __('_AJAX_LOGIN_').innerHTML = connect.responseText;
          __('user_login').disable = false;
          __('pass_login').disable = false;
        }
      } else if(connect.readyState != 4) {
        result = '<div class="alert alert-dismissible alert-warning">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += "<img src='Public/img/3.gif' />";
        result += '<p><strong>Estamos intentando logearte....</strong></p>';
        result += '</div>';
        __('_AJAX_LOGIN_').innerHTML = result;
        __('user_login').disable = true;
        __('pass_login').disable = true;
      }
    }
    connect.open('POST','/brainscube/ajax.php?mode=login',true);
    connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    connect.send(form);
}
