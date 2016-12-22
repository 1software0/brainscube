<?php

class homeController extends Controllers {

  public function __construct() {
    parent::__construct();
    if (isset($_SESSION['app_id'])) {
      $user =  User::Datos('Nombrec');
    } else {
      $user = false;
    }

    //haciendo conexion a la base de datos y recopilando sliders
    $bd    = new Conexion();
    $images = $bd->select('url','imagenes', 'id in (select idI from slider) UNION select desc_2 from slider');
    $n      = $bd->select('desc_2', 'slider');
    $number = count($n);

    echo $this->template->render('home/home', array ('data_header' =>array('url' => '',
     'nombre' => 'Home',
     'user' => $user,
     'carro' => false
   ),
   'number'=> $number,
   'data_slider' => array('n' => $n, 'images' => $images)
   )
   );

  }

}

?>
