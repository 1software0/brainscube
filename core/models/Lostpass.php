<?php

final class Lostpass extends Models implements OCREND {


  public function __construct() {
    parent::__construct();
  }

  final public function Reset_pass(array $data) : array {
    Helper::load("Strings");
    if (isset($data['key'])) {
      $key = $this->db->scape($data['key']);
      $pas = $this->db->scape($data['pass']);
      if (User::Reset_pass($key,Strings::hash($pas))) {
        $success = 1;
        $message = 'Se ha restablecido su contraseña. <a href="login/">Inicia sesión</a>';
      }
    } else {
      $mail = $this->db->scape($data['email']);
      $e_mail = Strings::encrypt_($mail);
      $u = $this->db->select('id, user','usuarios',"Correo = '$e_mail'", 'LIMIT 1');
      if (!($u === false)) {

    		$user = $u;

    			$id = $user[0]['id'];
    			$u = idate('U', date('U'));
          $usuer = Strings::decrypt_($user[0]['user']);
    			$keypass = Tkses::GenerarSID();

    			$HTML = 'Hola <b>'. $usuer .'</b>, has solicitado recuperar tu contraseña perdida, si no has realizado esta acción no necesitas hacer nada.
    					<br />
    					<br />
    					Para cambiar tu contraseña haz <a href="'. URL .'lostpass/key/'.$keypass.'" target="_blank">clic aquí</a>.';

    			Helper::load('emails');
    			$dest[$mail] = $usuer;
    			$email = Emails::send_mail($dest,Emails::plantilla($HTML),'Recuperar contraseña perdida');

    			if(true === $email) {
    				$e = array(
    					'keypass' => $keypass,
    					'keypass_tmp' => $u+86400
    				);
    				$this->db->update('usuarios',$e,"id='$id'");
    				$success = 1;
    				$message = 'Hemos enviado un email a <b>' . $mail . '</b> para recuperar su contraseña.';
          }
      } else {
        $success = 0;
        $message = 'El <b>email</b> introducido no existe.';
      }
    }
    return['message' => $message, 'success' => $success];
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
