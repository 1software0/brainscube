<?php
class loginController extends Controllers {

  public function __construct() {
    parent::__construct();
    if (isset($_SESSION["app_id"])) {
      if (isset($_GET['continue'])) {
        Func::redir($_GET['continue']);
      } else {
        Func::redir();
      }
    }
    if (isset($_SESSION['ac'])) {
      unset($_SESSION['ac']);
    }
    echo $this->template->render('home/login',
     array('data_header' => array('url' => '',
     'nombre' => 'Login',
     'user' => false,
     'carro' => false
   ),
     'data_info' => array(
       'nombre' => 'Inicio de sesion',
       'name_min' => 'login'
     )
   )
   );
  }

}
 ?>
