<?php

final class Carrito extends Models implements OCREND {

  public $articulos = [];
  private $session_id;
  private $expira = 0;

  public function __construct() {
    parent::__construct();
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
