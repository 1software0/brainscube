<?php

class accountController extends Controllers {

  public function __construct() {
    parent::__construct();
    $token = Tkses::GenerarSID();
    $_SESSION['token'] = $token;

    echo $this->template->render('account/account', array('data_header' => array('url' => '',
    'nombre' => 'Mi cuenta',
    'user' => User::Datos('Nombrec'),
    'carro' => false
  ),
    'data_info' => array(
      'nombre' => 'Mi Cuenta',
      'name_min' => 'account'
    ),
    'user' => User::Datos(),
    'token' => $token
  )
    );
  }

}

?>
