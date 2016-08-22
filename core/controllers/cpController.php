<?php

class cpController extends Controllers {

  public function __construct() {

    parent::__construct(true,false,1);

    switch ($this->route->getMethod()) {
      case 'dashboard':
      echo $this->template->render('cp/cp', array('data_header' => array('url' => '',
      'nombre' => 'Panel de administración',
      'user' => false,
      'carro' => false
    ),
      'data_info' => array(
        'nombre' => 'Panel de administración',
        'name_min' => 'Dashboard'
      )
    )
      );
        break;

        case 'team':
        echo $this->template->render('cp/team', array('data_header' => array('url' => '',
        'nombre' => 'Equipo',
        'user' => false,
        'carro' => false
      ),
        'data_info' => array(
          'nombre' => 'Panel de administración',
          'name_min' => 'Equipo'
        )
      )
        );
          break;

      default:
      echo $this->template->render('cp/cp', array('data_header' => array('url' => '',
      'nombre' => 'Panel de administración',
      'user' => false,
      'carro' => false
    ),
      'data_info' => array(
        'nombre' => 'Panel de administración',
        'name_min' => 'Dashboard'
      )
    )
      );
        break;
    }

  }

}

?>
