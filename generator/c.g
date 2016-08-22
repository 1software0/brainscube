<?php

class {{controller}} extends Controllers {

  public function __construct() {
    parent::__construct();
    echo $this->template->render('{{view}}/{{view}}', array('data_header' => array('url' => '',
    'nombre' => '{{view}}',
    'user' => false,
    'carro' => false
  ),
    'data_info' => array(
      'nombre' => '{{view}}',
      'name_min' => '{{view}}'
    )
  )
    );
  }

}

?>
