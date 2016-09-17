<?php

class registroController extends Controllers {

  public function __construct() {
    parent::__construct(false,true);

    if (isset($_GET["reg"])) {
      Func::redir();
    }
    //
    $store = new Store;

    echo $this->template->render('home/registro',
     array('data_header' => array('url' => '',
      'nombre' => 'Registro',
      'user' => false,
      'carro' => false
    ),
    'correo' => (isset($_POST["email"])) ? $_POST["email"] : "",
    'data_info' => array(
      'nombre' => 'Registro',
      'name_min' => 'registro'
    )
    )
  );
  }

}

?>
