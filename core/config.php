<?php

# Tipado estricto para PHP 7
declare(strict_types=1);

//------------------------------------------------

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

# Timezone DOC http://php.net/manual/es/timezones.php
date_default_timezone_set('America/Mexico_City');

//------------------------------------------------

# Control global de sesiones DOC http://php.net/manual/es/session.configuration.php
session_start([
  'use_strict_mode' => true,
  'use_cookies' => true,
  'cookie_httponly' => true, # Evita el acceso a la cookie mediante lenguajes de script (cómo javascript)
  'hash_function' => 7
]);

//------------------------------------------------

# Idioma base
try {
  setlocale(LC_ALL,'es_ES');
} catch (Error $e) {
  die('Comentar líneas 26 hasta 34 en ./core/config.php');
}

//------------------------------------------------

# Prevención de errores en el hash
try {
  if(0 == CRYPT_BLOWFISH)
    throw new Exception(true);
} catch (Exception $e) {
  die('CRYPT_BLOWFISH no soportado, algoritmo de hash actual no funcional.');
}

//------------------------------------------------

/**
  * Configuración de la conexión con la base de datos.
  * @param host 'hosting local/remoto'
  * @param user 'usuario de la base de datos'
  * @param pass 'password del usuario de la base de datos'
  * @param name 'nombre de la base de datos'
  * @param port 'puerto de la base de datos (no necesario en la mayoría de motores)'
  * @param protocol 'protocolo de conexión (no necesario en la mayoría de motores)'
  * @param motor 'motor de conexión por defecto'
  * MOTORES VALORES:
  *        mysql
  *        sqlite
  *        oracle
  *        postgresql
  *        cubrid
  *        firebird
  *        odbc
*/
define('DATABASE', array(
  'host' => 'localhost',
  'user' => 'root', // softwar8_brain
  'pass' => 'toor', // m;(LQ1h2{3lN //%4040Bd2/6!
  'name' => 'brainscube', // softwar8_brainscube
  'port' => 3306,
  'protocol' => 'TCP',
  'motor' => 'mysql'
));

//------------------------------------------------
# PayPal SDK
define('PAYPAL_MODE','sandbox'); # sandbox ó live
define('PAYPAL_CLIENT_ID','');
define('PAYPAL_CLIENT_SECRET','');

//------------------------------------------------

# Constantes fundamentales
define('URL', 'http://brainscube.com/');
define('APP', 'Brains Store');
define('SESS_APP_ID', 'app_id');
define('APP_COPY','Copyright &copy; ' . date('Y',time()) . ' Brains Cube.');

/**
  * Define la carpeta en la cual se encuentra instalado el framework.
  * @example "/" si para acceder al framework colocamos http://url.com en la URL, ó http://localhost
  * @example "/Ocrend-Framework/" si para acceder al framework colocamos http://url.com/Ocrend-Framework, ó http://localhost/Ocrend-Framework/
*/
define('__ROOT__', '/');

//------------------------------------------------

# Constantes de PHPMailer
define('PHPMAILER_HOST','host.hddcms3.com');
define('PHPMAILER_USER','no-responder@brainscube.com');
define('PHPMAILER_PASS','+y$cEPD@4Ky3');
define('PHPMAILER_PORT',465);

//------------------------------------------------

# Activación del Firewall
define('FIREWALL', true);

//------------------------------------------------

# Activación del DEBUG, solo para desarrollo
define('DEBUG', true);

?>
