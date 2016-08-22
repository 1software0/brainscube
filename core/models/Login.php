<?php

final class Login extends Models implements OCREND {

  private $user;

  public function __construct() {
    parent::__construct();
  }

  final public function SignIn(array $data) : array {

    Helper::load('strings');
    $this->user = Strings::encrypt_($this->db->scape($data['user']));

    $u = $this->db->select('id,pass,Permisos','usuarios',"user='$this->user'",'LIMIT 1');
    if(false != $u and Strings::chash($u[0][1],$data['pass'])) {
      $tk = Tkses::TSID($u[0][0]) or die("No se pudo iniciar sesion");
      $_SESSION[SESS_APP_ID] = $tk[2];
      $success = 1;
      $message = 'Conectado, estamos redireccionando.';
    } else {
      $success = 0;
      $message = 'Credenciales incorrectas.';
    }

    return array('success' => $success, 'message' => $message);
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
