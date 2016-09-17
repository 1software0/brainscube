<?php

final class Wishlist extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  final public function Agregar(array $data) : array {
    Helper::load('Strings');
    $success = 0;
    $message = 'funcionando Agregar';
    if ($data['idp'] != "" and isset($_SESSION[SESS_APP_ID])) {
      $link = $data['idp'];
      $idp = Articulo::getIdbyLink($link);
      $idu = Tkses::getUserbyTK($_SESSION[SESS_APP_ID]);
      if ($this->db->select('*','lista_deseos',"idu = '$idu' and idp = $idp") === false) {
        $this->db->insert('lista_deseos', array('idp' => $idp, 'idu' => $idu));
      }
      $success = 1;
      $message = 'Se ha agregao a tu lisa de deseos';
    } elseif ($data['idp'] == "") {
      $success = 0;
      $message = 'Ha ocurrido un error desconocido.';
    } else {
      $success = 0;
      $message = 'Necesita iniciar Sesión. <a href="login/"> Aqui </a> para iniciar sesión.';
    }
    return array('success' => $success, 'message' => $message);
  }

  final public function Eliminar(array $data) : array {
    Helper::load('Strings');
    $success = 0;
    $message = 'funcionando Eliminar';
    if ($data['idp'] != "" and isset($_SESSION[SESS_APP_ID])) {
      $link = $data['idp'];
      $idp = Articulo::getIdbyLink($link);
      $idu = Tkses::getUserbyTK($_SESSION[SESS_APP_ID]);
      $this->db->delete('lista_deseos', "idp = '$idp' and idu = '$idu'");
      $success = 1;
      $message = 'Se ha eliminado de tu lisa de deseos';
    } elseif ($data['idp'] == "") {
      $success = 0;
      $message = 'Ha ocurrido un error desconocido.';
    } else {
      $success = 0;
      $message = 'Necesita iniciar Sesión. <a href="login/"> Aqui </a> para iniciar sesión.';
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
        for ($i=0;$i<count($wl);$i++) {
          $a = new Articulo;
          $a->_gp_($wl[$i][0]);
          $store->productos[$i] = $a;
          $a->__destruct();
        }
        return $store;
      }
    }
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
