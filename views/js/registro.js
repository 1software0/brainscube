function Reg() {
  var connect, form, response, result, user, pass, email, tyc, pass_dos,apell,name;
  name = __('user_name').value;
  apell = __('user_last').value;
  user = __('user').value
  pass = __('pass').value;
  email = __('email_reg').value;
  pass_dos = __('pass_2').value;
  tyc = __('tyc_reg').checked ? true : false;

  if(true == tyc) {
    if( pass != '' && pass_dos != '' && email != '' && name != '' && apell !='' ) {
      if(pass == pass_dos) {
        form = 'user=' + user + '&pass=' + pass + '&email=' + email + '&name=' + name + '&apell=' + apell;
        connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        connect.onreadystatechange = function() {
          if(connect.readyState == 4 && connect.status == 200) {
            if(connect.responseText == 1) {
              result = '<div class="alert alert-dismissible alert-success">';
              result += '<h4>Registro completado!</h4>';
              result += '<p><strong>Estamos redireccionandote...</strong></p>';
              result += '</div>';
              __('_AJAX_REG_').innerHTML = result;
              document.location.href = "?reg=true";
            } else {
              __('_AJAX_REG_').innerHTML = connect.responseText;
            }
          } else if(connect.readyState != 4) {
            result = '<div class="alert alert-dismissible alert-warning">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += "<img src='/brainscube/Public/img/3.gif' />";
            result += '<p><strong>Estamos procesando tu registro...</strong></p>';
            result += '</div>';
            __('_AJAX_REG_').innerHTML = result;
          }
        }
        connect.open('POST','/brainscube/ajax.php?mode=reg',true);
        connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        connect.send(form);
      } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<h4>ERROR</h4>';
        result += '<p><strong>Las contraseñas no coinciden.</strong></p>';
        result += '</div>';
        __('_AJAX_REG_').innerHTML = result;
      }
    } else {
      result = '<div class="alert alert-dismissible alert-danger">';
      result += '<button type="button" class="close" data-dismiss="alert">x</button>';
      result += '<h4>ERROR</h4>';
      result += '<p><strong>Todos los campos deben estar llenos.</strong></p>';
      result += '</div>';
      __('_AJAX_REG_').innerHTML = result;
    }
  } else {
    result = '<div class="alert alert-dismissible alert-danger">';
    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
    result += '<h4>ERROR</h4>';
    result += '<p><strong>Los términos y condiciones deben ser aceptados.</strong></p>';
    result += '</div>';
    __('_AJAX_REG_').innerHTML = result;
  }

}
function goReg(e) {
  if(e.keyCode == 13) {
    Reg();
  }
}
