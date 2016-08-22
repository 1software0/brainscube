function __($id) {
  return document.getElementById($id);
}

function activar() {
    var connect, form, response, key, result, user, pass, sesion;
    user = __('user_login').value;
    key = __('key').value;
    form = 'user=' + user + '&key=' + key;
    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    connect.onreadystatechange = function() {
      if(connect.readyState == 4 && connect.status == 200) {
        if(connect.responseText == 1) {
          result = '<div class="alert alert-dismissible alert-success">';
          result += '<h4>Activado!</h4>';
          result += '<p><strong>Estamos redireccionandote...</strong></p>';
          result += '</div>';
          __('_AJAX_LOGIN_').innerHTML = result;
          location.href = "/brainscube/_/index/login?s=true";
        } else {
          __('_AJAX_LOGIN_').innerHTML = connect.responseText;
          __('user_login').disable = false;
        }
      } else if(connect.readyState != 4) {
        result = '<div class="alert alert-dismissible alert-warning">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += "<img src='Public/img/3.gif' />";
        result += '<p><strong>procesando....</strong></p>';
        result += '</div>';
        __('_AJAX_LOGIN_').innerHTML = result;
        __('user_login').disable = true;
      }
    }
    connect.open('POST','/brainscube/ajax.php?mode=active',true);
    connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    connect.send(form);
}
function goAct(e) {
  if(e.keyCode == 13) {
    Reg();
  }
}
