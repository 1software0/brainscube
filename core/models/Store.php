<?php

final class Store extends Models implements OCREND {

  public $productos = [];
  public $data = [];
  public $total_p = 0;
  public $p = [];


  public function __construct() {
    parent::__construct();
    $data = $this->GetStoredata();
  }

  final public function GetStoredata() : array {
    $variable = $this->db->select('*','store_data');
    $n = array();
    foreach ($variable as $key => $value) {
      $n[$key] = $value;
    }
    return $n;
  }

final static public function Rating(int $id) {
  $db = Conexion::Start();
  $rat = $db->select('rate','review',"id='$id'");
  $final = 0;
  if ($rat != false) {
    for ($n=0; $n < count($rat); $n++) {
      $final = $final + $rat[$n][0];
    }
    $final = $final/(count($rat));
    $final = ceil($final);
    return [$final,count($rat)];
  } else {
    return [0,0];
  }
}
/*
 * Se llena $this->productos de productos reelevantes para el usuario
 *
 * @param string $search : En caso de existir es una consulta
 * @param string $order_by: en caso de existir es el orden de regreso de los
 * modelos articulo
 * @param int $limit: Los articulos a mostrar por página
 * @param int $start: En caso de no empezar por el 0
 *
 * @return null : Los datos se almacenan dentro de $this->productos
 */
  final public function getProducts(string $search = NULL,  string $order_by = NULL,int $limit = NULL, int $start = NULL) {
    if ($order_by === NULL) {
      $order_by = "1=1";
    }
    if ($limit === NULL) {
      $limit = 12;
    }
    if ($start === NULL) {
      $start = 0;
    }
    Helper::load('Strings');

    $order_by = $this->db->scape($order_by);
    $limit = $this->db->scape($limit);
    $start = $this->db->scape($start);

    if ($search === NULL || $search === "" || !(Strings::alphanumeric($search))) {
      $prods  = $this->db->select('id','catalogo',$order_by);
        $this->total_p = count($prods);
        $limit = min(  $this->total_p, $limit );
      if ($prods !== false) {
        $m = 0;
        for ($i=$start; $i < $limit; $i++) {
          $art = new Articulo();
          $art->_gp_($prods[$i][0]);
          $this->productos[$i] = $art;
          $this->p[$m] = $art->precio;
          $m++;
          $art->__destruct();
        }
        $this->total_p = count($prods);
      }
    } else {
      $sea = 'Nombre LIKE'." '%".$this->db->scape($search)."%'";
      $prods  = $this->db->select('id','catalogo', $sea);
      $this->total_p = count($prods);
        $limit = min(  $this->total_p, $limit );
      if ($prods !== false || count($prods) != 0) {
        $m = 1;
        for ($i=$start; $i < $limit; $i++) {
          $art = new Articulo();
          $art->_gp_($prods[$i][0]);
          $this->productos[$i] = $art;
          $this->p[$m] = $art->precio;
          $m++;
          $art->__destruct();
        }
          $this->total_p = count($prods);
      } else {
        $this->total_p = count($prods);
        $this->p[0] = 0;
      }
    }
  }
  //regresa el total de productos de catalogo
final public static function total(): int {
  $db = Conexion::Start();
  $prods  = $db->select('id','catalogo');
  return (int) count($prods);
}
// regesa en un arreglo el precio maximo y el minimo de la consulta actual
final public function procesPrices() {
    return [min($this->p),max($this->p)];
}
/*
 * Se llena $this->productos de productos reelevantes para el usuario
 *
 * @param int $id : El id del articulo que se va a agregar a la whish list
 *
 * @return array : Hubo exito en la operación
 */
final public function addWhislist(int $id) {
  if ($this->app_id = NULL) {
    $id = Tkses::getUserbyTK($this->app_id);
    $e = ['idu'=>'$id','idp'=>'$p'];
    $this->db->insert('lista_deseos',$e) or die(false);
    return true;
  }
}

  public function __destruct() {
    parent::__destruct();
  }

}

?>
