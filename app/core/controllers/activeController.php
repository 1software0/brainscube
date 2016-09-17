<?php

class activeController extends Controllers {

  public function __construct() {
    parent::__construct();
    $router = new Router();
    $e = false;
    $mensaje = '';
    if ($router->getMethod()!= '') {
      if (isset($_POST['key'])) {
        echo User::IsactivateKey($_POST['key']) . " ". User::IsUser_key($_POST['user'],$_POST['key']);
        if (User::IsactivateKey($_POST['key']) && User::IsUser_key($_POST['user'],$_POST['key'])) {
            User::Active($_POST['user']) or die('Error al activar al usuario');
            $_SESSION['ac'] = true;
            Func::redir( URL .'login?s=true');
          } else {
            if (!User::IsactivateKey($_POST['key'])) {
              $mensaje = 'El Usuario no concuerda con la clave de activación.';
              $e = true;
            } else {
              $mensaje = 'Lo sentimos pero esa no es una clave válida.';
              $e = true;
          }
        }
      }
    } else {
        Func::redir();
    }
    echo $this->template->render('home/active',
    array('data_header' => array('url' => '',
    'nombre' => 'activate',
    'user' => false,
    'carro' => false
  ),
    'data_info' => array(
      'nombre' => 'Activar Cuenta',
      'name_min' => 'activate'
    ),
    'mensaje' => $mensaje,
    'e' => $e,
    'ky' => $router->getMethod()
  )
);
  }

}

 ?>
