<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

abstract class Controllers {

  //------------------------------------------------

  protected $template;
  protected $isset_id;
  protected $method;
  protected $route;

  //------------------------------------------------

  /**
    * Constructor, inicializa los alcances de todos los Controladores
    *
    * @param bool $LOGED: Si el controlador en cuestión será exclusivamente para usuarios logeados, se pasa TRUE
    * @param bool $UNLOGED: Si el controlador en cuestión será exclusivamente para usuarios NO logeados, se pasa TRUE
    *
    * @return void
  */
  protected function __construct(bool $LOGED = NULL, bool $UNLOGED = NULL, int $permisos = NULL) {

    if ($LOGED === NULL) {
      $LOGED = false;
    }
    if ($UNLOGED === NULL) {
      $UNLOGED = false;
    }
    if ($permisos === NULL) {
      $permisos = 0;
    }

    global $router;

    # Accedemos a el router para URL's amigables
    $this->route = $router;

    #verificamos que tenga una sessón activar
    if (isset($_SESSION[SESS_APP_ID])) {
      if(!Tkses::_exist_TSID($_SESSION[SESS_APP_ID])) {
        Tkses::end_TSID($_SESSION[SESS_APP_ID]);
        unset($_SESSION[SESS_APP_ID]);
        unset($_SESSION['user']);
        session_write_close();
        session_unset();
      }
   }

    # Restricción para usuarios logeados
    if($LOGED and !isset($_SESSION[SESS_APP_ID])) {
      Func::redir();
      exit;
    }

    # Restriccion de Permisos
    if (isset($_SESSION[SESS_APP_ID])) {
      if (User::getpermisos() < $permisos) {
        Func::redir();
        exit;
      }
    }

    # Restricción de página para ser visa sólamente por usuarios No logeados
    if($UNLOGED and isset($_SESSION[SESS_APP_ID])) {
      Func::redir();
      exit;
    }

    # Carga del template
    $this->template = new League\Plates\Engine('templates','phtml');

    # Debug
    if(DEBUG) {
      $_SESSION['___QUERY_DEBUG___'] = array();
    }

    # Utilidades
    $this->method = ($router->getMethod() != null and Strings::alphanumeric($router->getMethod())) ? $router->getMethod() : null;
    $this->isset_id = ($router->getId() != null and is_numeric($router->getId()) and $router->getId() >= 1);

  }

}

?>
