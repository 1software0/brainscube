<?php

final class Articulo extends Models implements OCREND {

  public $titulo = null;
  public $imgs = [null];
  public $descripcion = [null,null];
  public $marca = null;
  public $precio = 0;
  public $rating = [0,0];
  public $specs = [null];
  public $stock = [false,0];
  public $link = null;
  public $reviews = [];
  public $ck = false;

  public function __construct() {
    parent::__construct();
  }

  final public function _gp_(int $id) {
    $prod = $this->db->select('*','catalogo',"id='$id'",'LIMIT 1');

    $this->titulo = $prod[0]['Nombre'];
    $idu = (isset($_SESSION[SESS_APP_ID])) ? Tkses::getUserbyTK($_SESSION[SESS_APP_ID]) : 'AAABBBCCC123';

    $imags = $this->db->select('url','imagenes',"id_art='$id'");
    for ($i=0; $i < count($imags); $i++) {
      $this->imgs[$i] = $imags[$i][0];
    }

    $this->descripcion = [$prod[0]['Des_corta'],$prod[0]['Des_larga']];

    $mar = $this->db->select('nombre','marcas',"id='".$prod[0]['marcas_id']."'",'LIMIT 1');
    $this->marca = $mar[0][0];

    $this->precio = $prod[0]['Precio'];

    $this->rating = Store::Rating($id);

    $s = $this->db->select('cantidad','stock',"idart='$id'",'ORDER BY identrada DESC LIMIT 1');
    $this->stock = ($s != false) ? [true,$s[0][0]] : [false,0];

    $this->link = $prod[0]['link'];

    $this->reviews = $this->db->select('*','review',"id='$id'");

    $this->ch = ($this->db->select('idp','lista_deseos',"idp = ".$prod[0][0]." and idu = '$idu'",'LIMIT 1') === false) ? false : true ;

    /*$sp = $this->db->select('name,value','specs',"id_art='$id'");
    for ($i=0; $i < count($sp); $i++) {
      $this->specs[$sp[$i][0]] = $sp[$i][1];
    }*/
  }
  //------------------------------------------------

  /**
    * Da el precio de un articulo en pesos
    *
    * @param int $precio: Un entero el precio
    *
    * @return string con el precio mostrando 2 puntos decimales $ 1,000.00
  */
  final static public function dar_precio(int $precio): string {
    $dos = ($precio / 100);
    $result = '';
    if (!is_float($dos)) {
      $cents = ".00";
    } else {
      $cents = '.'.substr($dos.'',-2);
      $dos = intval($dos);
    }
    if (strlen($precio) < 6) {
      $result = "$ ".$dos.$cents." MXN";
    } else {
      if (strlen($precio) < 9) {
        $tres = substr($precio.'', 0, (strlen($precio)-5)).', ';
        $result = '$ '.$tres.substr($dos.'', (strlen($precio)-5), 3).$cents." MXN";
      } else {
        $tres = substr($precio.'', 0,(strlen($precio)-8)).'\' ';
        $cuatro = substr($dos.'', (strlen($dos) - 6),(strlen($dos) - 5)).', ';
        $result = "$ ".$tres.$cuatro.substr($dos.'', -3,3).$cents." MXN";
      }
    }
    return $result;
  }
  //------------------------------------------------

  /**
    * Regresa el id de un producto dado el link
    *
    * @param string $id: El link del producto
    *
    * @return int con el id del producto
  */
  final static public function getIdbyLink(string $id): int {
    $db = Conexion::start();
    $link = $db->scape($id);
    $t = $db->select('id','catalogo',"link='$link'",'LIMIT 1');

    return (int) $t[0][0];
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
