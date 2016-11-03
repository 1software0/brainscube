<?php

class carroController extends Controllers {


  public function __construct() {
    parent::__construct();

    if (isset($_SESSION[SESS_APP_ID])) {
      $user =  User::Datos('Nombrec');
      if (isset($_SESSION["carro"])) {
        $carro = Carro::load_cart_details();
      } else {
        $carro = false;
      }

    } else {
      $user = false;
      $carro = false;
    }

    if (isset($_SESSION["carro"])) {
      $tienda = json_decode($_SESSION["carro"]);
    } else {
      $tienda = null;
    }

    echo $this->template->render('carro/carro', array('data_header' => array('url' => '',
    'nombre' => 'Carrito de compra',
    'user' => $user,
    'carro' => $carro
  ),
    'data_info' => array(
      'nombre' => 'Tu carrito de compra',
      'name_min' => 'carro'
    ),
    'tienda' => $tienda
  )
    );
  }

}

?>
