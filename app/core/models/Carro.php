<?php

final class Carro extends Models implements OCREND {

  public $deadline;
  public $status;
  public $total = 0;
  public $productos = array( "index" => [], "cantidad" => [],"datos" => []);
  public $pendiente = true;
  public $codigos_descuento = [];

  public function __construct() {
    parent::__construct();
  }

  /*
   * Esta funcion regresa el carrito de compras como objeto o falso si no hay
   *
   *  @return (mixed) Objeto carro y si no existe false.
   *
   */
  final public static function load_cart_details() {
    if (isset($_SESSION["carro"]) and (!isset($_SESSION["carro_error"]) or !isset($_SESSION["carro_mensaje"]))) {
      return json_decode($_SESSION["carro"]);
    } else {
      return false;
    }
  }

  /*
   * Agrega un producto al carrito de compra
   *
   *  @param $data["producto"]: es el link del producto a agregar
   *  @param $data["cantidad"]: [opcional] es la cantidad de archivos que se
   *    van a agregar
   *
   *  @return array datos para el json
   *
   */
  final public function agregar_producto($data) {

    Helper::load("Arrays");

    $li = $this->db->scape($data["producto"]);
    $id = Articulo::getIdbyLink($li);
    $cantidad = (isset($data["cantidad"])) ? $this->db->scape($data["cantidad"]) : 1 ;
    $a = new Articulo;
    $a->_gp_($id);
    $producto = ["titulo" => $a->titulo,"precio" => $a->precio,"link" => $a->link,"imagen" => $a->imgs[0],"stock" => $a->stock];

    if (isset($_SESSION["carro"])) {
      $carro = json_decode($_SESSION["carro"]);
      if ($carro->status != "activo") {
        switch ($carro->status) {
          case 'error':
            $carro->status = "inactive";
            unset($_SESSION["carro"]);
            $_SESSION["carro_error"] = 1;
            $_SESSION["carro_mensaje"] = "Se ha producido un error en su carrito.";
            break;

          case 'done':
            unset($_SESSION["carro"]);
            $_SESSION["carro_mensaje"] = "Se ha completado su pedido. Puede ver sus pedidos en <a href='/ordenes'>Aquí</a>.";
            break;

          case 'in_payment':
            $_SESSION["carro_mensaje"] = "No puede agregar productos a su carrito.";
            break;

	  case 'inactie':
	    break;

          default:
            unset($_SESSION["carro"]);
            $_SESSION["carro_error"] = 1;
            $_SESSION["carro_messaje"] = "Se ha producido un error en su carrito.";
            break;
        }
        $success = 0;
        $message = (isset($_SESSION["carro_mensaje"])) ? $_SESSION["carro_mensaje"] : "";
      } else {
        unset($_SESSION["carro_error"]);
        unset($_SESSION["carro_mensaje"]);
        if (in_array($li,$carro->productos->index) != -1) {
          $i = count($carro->productos->index);
          $carro->productos->datos[$i] = $producto;
          $carro->productos->cantidad[$i] = 1;
          $carro->productos->index[$i] = $li;
          $carro->total += $producto["precio"];
          $_SESSION["carro"] = json_encode($carro);
          $success = 1;
          $message = "Se ha agregado el produto a tu carrito. Puedes ver el contenido de tu carrito <a href='/tienda'>aquí</a>.";
        } else {
          $success = 0;
          $message = "Este articulo ya esta en su carrito";
        }
      }
    } else {
      unset($_SESSION["carro_error"]);
      unset($_SESSION["carro_mensaje"]);
      $carro = new Carro;
      $carro->deadline = time()+3600;
      $carro->status = "activo";
      $i = 0;
      $carro->productos["datos"][$i] = $producto;
      $carro->productos["cantidad"][$i] = $cantidad;
      $carro->productos["index"][$i] = $li;
      $carro->total = $producto["precio"];
      $_SESSION["carro"] = json_encode($carro);
      $success = 1;
      $message = "Se ha agregado el produto a tu carrito. Puedes ver el contenido de tu carrito <a href='/tienda'>aquí</a>.";
      $carro->__destruct();
    }
    $a->__destruct();
    return array('success' => $success, 'message' => $message, 'new_carro' => json_encode($carro));
  }

  /*
   *Quita un producto del carrito
   *
   *  @param $data["producto"]: El link del proucto a eliminar
   *
   *  @return array: Si hubo exito un mensaje y el nuevo carrito.
   */
  final public function quitar_producto($data) {
    Helper::load("Arrays");
    $li = $this->db->scape($data["producto"]);

    $carro = (isset($_SESSION["carro"])) ? json_decode($_SESSION["carro"]) : false;
    if (in_array($li,$carro->productos->index) > 0 and $carro != false) {

      if (count($carro->productos->index) >= 1) {
        $i = in_array($li,$carro->productos->index);

        $carro->total += -1*($carro->productos->datos[$i]->precio*$carro->productos->cantidad[$i]);

        $carro->productos->cantidad[$i] = "";
        $carro->productos->datos[$i] = "";
        $carro->productos->index[$i] = "";

        $_SESSION["carro"] = json_encode($carro);

        $success = 1;
        $message = "Se ha eliminado el producto de tu carrito.";
      } else {
        unset($_SESSION["carro"]);
        $carro = null;
        $success = 1;
        $message = "Se ha eliminado el producto de tu carrito.";
      }
    } else if ($carro) {
      $success = 0;
      $message = "No existe el producto que quiere eliminar";
    } else {
      $success = 0;
      $message = "No tiene un carrito todavía.";
    }
    return array('success' => $success, 'message' => $message, 'new_carro' => json_encode($carro));
  }

  /*
   * Actualiza los precios y las cantidades del carrito
   *
   *
   *
   */
  final public function procesar_pedido() {

  }

  /*
   *
   *
   *
   *
   */
  final public function procesar_pago() {

  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
