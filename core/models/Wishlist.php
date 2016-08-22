<?php

final class Wishlist extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  final public function Foo(array $data) : array {
    Helper::load('Strings');
    $success = 0;
    $message = 'funcionando';
    if ($data['idp'] != "" and false) {
      $link = $data['idp'];
      $idp = Articulo::getIdbyLink($link);
      $idu = Tkses::getUserbyTK($_SESSION[SESS_APP_ID]);
      $this->db->insert('lista_deseos', array('idp' => $idp, 'idu' => $idu));
      $success = 1;
      $message = 'Se ha agregao a tu lisa de deseos';
    }
    return array('success' => $success, 'message' => $message);
  }

  //-----------------------------------------------------

  /*
   * Una funcion que recuera los datos de la lista de deseos del usuario
   * logueado De no encontrar al usuario logueado regresa false *
   *
   * return false o objeto Store con los productos
   */
  final public static function getUserWishlist() {
    if (isset($_SESSION[SESS_APP_ID])) {
      $idu = Tkses::getUserbyTK($_SESSION[SESS_APP_ID]);
      $db = Conexion::start();
      $wl = $db->select('idp','lista_deseos',"idu = '$idu'");
      if ($wl === false) {
        return false;
      } else {
        $store = new Store;
        $i = 0;
        foreach ($wl as $key => $value) {
          $a = new Articulo;
          $a->_gp_($value[0]);
          $store->productos[$i] = $a;
          $i++;
          $a->__destruct;
        }
      }
    }
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
