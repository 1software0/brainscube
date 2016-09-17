<?php

class lostpassController extends Controllers {

  public function __construct() {
    parent::__construct(false,true);
    $router = new Router();
    $e = ['','0'];
    if ('key' == $router->getMethod()) {
      if (!(User::is_pass_key($router->getId()))) {
      $user = '';
        $e = ['la clave no es correcta o ha expirado.','1'];
      }
    }
    echo $this->template->render('lostpass/lostpass', array('data_header' => array('url' => '',
    'nombre' => 'Recuperar contraseña',
    'user' => false,
    'carro' => false
  ),
    'data_info' => array(
      'nombre' => 'Recuperar contraseña',
      'name_min' => 'lostpass'
    ),
    'recovery' => 'key' == $router->getMethod(),
    'ky' => $router->getId(),
    'e' => $e
  )
    );
  }

}

?>
