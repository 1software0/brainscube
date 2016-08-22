<?php

class errorController extends Controllers {

  public function __construct() {
    parent::__construct();

    if (isset($_SESSION['app_id'])) {
      $user =  User::Datos('Nombrec');
    } else {
      $user = false;
    }
    
    echo $this->template->render('error/error', array('data_header' => array('url' => '',
    'nombre' => 'Error 404',
    'user' => $user,
    'carro' => false
  ),
    'data_info' => array(
      'nombre' => 'Error 404',
      'name_min' => 'No se pudo completar su solicitud'
    ),
    'req' => $_SERVER['REQUEST_URI']
  )
    );
  }

}

?>
