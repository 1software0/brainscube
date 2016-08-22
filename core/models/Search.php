<?php

final class Search extends Models implements OCREND {

  public $search_q;
  public $result;

  public function __construct() {
    parent::__construct();
  }

  final public function Foo(array $data) : array {
    $this->result = [];
    $c = 0;
    $this->search_q = $this->db->scape($data['q']);
    if (isset($data['m'])) {
      $m = $this->db->select('nombre','marcas',"nombre LIKE '%$this->search_q%'");
      if ($m != false) {
        foreach ($m as $key) {
          if ($c != 0) {
            if (isset($this->result[$c])) {
              if ($this->result[$c]['value'] != $key[0]) {
                $c++;
                $this->result[$c]['value'] = $key[0];
              }
            }
          } else {
            $c++;
            $this->result[$c]['value'] = $key[0];
          }
        }
      }
    }
    if (isset($data['p'])) {
      $m = $this->db->select('id,Nombre','catalogo',"Nombre LIKE '%$this->search_q%'");
      if ($m != false) {
        foreach ($m as $key) {
          if ($c != 0) {
            if (isset($this->result[$c])) {
              if ($this->result[$c]['value'] != $key[1]) {
                $c++;
                $a = new Articulo;
                $a->_gp_($key[0]);
                $this->result[$c]['link'] = __ROOT__.'tienda/producto/'.$a->link;
                $this->result[$c]['image'] = $a->imgs[0];
                $this->result[$c]['value'] = $a->titulo;
                $this->result[$c]['price'] = Articulo::dar_precio($a->precio);
                $a->__destruct();
              }
            }
          } else {
            $c++;
            $a = new Articulo;
            $a->_gp_($key[0]);
            $this->result[$c]['link'] = __ROOT__.'tienda/producto/'.$a->link;
            $this->result[$c]['image'] = $a->imgs[0];
            $this->result[$c]['value'] = $a->titulo;
            $this->result[$c]['price'] = Articulo::dar_precio($a->precio);
            $a->__destruct();
          }
        }
      }
    }
    return $this->result;

  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
