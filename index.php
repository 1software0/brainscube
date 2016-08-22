<?php

//------------------------------------------------

# Carga del núcleo
define('INDEX_DIR',true);
require('core/app_core.php');

//------------------------------------------------

# Detección del controlador actual
$Controller = $router->getController();

//------------------------------------------------

# Identificación del controlador en el sistema
if(!is_readable('core/controllers/' . $Controller . '.php')) {
  $Controller = 'errorController';
}

# Carga del controlador seleccionado
require('core/controllers/' . $Controller . '.php');
new $Controller;

//------------------------------------------------

# Modo debug
!DEBUG ?: new Debug($startime);

?>
