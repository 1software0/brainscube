<?php

class homeController extends Controllers {

  public function __construct() {
    parent::__construct();
    if (isset($_SESSION['app_id'])) {
      $user =  User::Datos('Nombrec');
    } else {
      $user = false;
    }

    $bd = new Conexion();
    //slider
    $n = $bd->select('idI, desc_2', 'slider');
    $number = count($n);



    if ($number > 0) {
      for ($i=0; $i < count($n); $i++) {
        $src = $bd->select('url','imagenes',"id='".$n[$i][0]."'",'LIMIT 1');
        $n[$i][0] = $src[0][0];
      }
    }




    echo $this->template->render('home/home', array ('data_header' =>array('url' => '',
     'nombre' => 'Home',
     'user' => $user,
     'carro' => false
   ),
   'number'=> $number,
   'data_slider' => array('n' => $n)
   )
   );

  }

}

?>
