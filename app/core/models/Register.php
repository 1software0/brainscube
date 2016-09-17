<?php

final class Register extends Models implements OCREND {


  public function __construct() {
    parent::__construct();
  }

  final public function SignUp(array $data) : array {

    if(Func::all_full($data)) {

      Helper::load('strings');
      $db = Conexion::Start();


      $user = Array ( "Cript" => Array (
        "pass" => Strings::hash($db->scape($data['pass'])),
        "user" => Strings::encrypt_($db->scape($data['user'])),
        "email" => Strings::encrypt_($db->scape($data['email'])),
        "name" => Strings::encrypt_($db->scape($data['user_name'])),
        "apell" => Strings::encrypt_($db->scape($data['user_last']))
      ), "no" => Array (
        "pass" => $db->scape($data['pass']),
        "user" => $db->scape($data['user']),
        "email" => $db->scape($data['email']),
        "name" => $db->scape($data['user_name']),
        "apell" => $db->scape($data['user_last'])
      )
      );

      $udate = idate('U', date('U'));
      if(Strings::is_email($user['no']['email'], FILTER_VALIDATE_EMAIL)) {
        $u = $this->db->select('user','usuarios',"user='".$user['Cript']['user']."' OR Correo='".$user['Cript']['email']."'",'LIMIT 1');
        if(false == $u) {
          $e = array(
            'Nombre' => $user['Cript']['name'],
            'Apellido' => $user['Cript']['apell'],
            'user' => $user['Cript']['user'],
            'Correo' => $user['Cript']['email'],
            'Permisos' => '0',
            'pass' => $user['Cript']['pass'],
            'ubicacion' => Func::ip_info($_SERVER['REMOTE_ADDR'],'country_code'),
            'active' => '0',
            'link' => Tkses::GenerarSID($udate)
          );

          $mail = new PHPMailer;
          //$mail->SMTPDebug = 3;
          $mail->CharSet = "UTF-8";
          $mail->Encoding = "quoted-printable";
          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = PHPMAILER_HOST;  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = PHPMAILER_USER;                 // SMTP username
          $mail->Password = PHPMAILER_PASS;                           // SMTP password
          $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
          $mail->SMTPOptions = array(
              'ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
              )
          );
          $link = URL . 'active/'.$e['link'];
          $mail->Port = PHPMAILER_PORT;                                    // TCP port to connect to

          $mail->setFrom(PHPMAILER_USER, APP); //Quien manda el correo?

          $mail->addAddress($user['no']['email'], $user['no']['name'] . ' ' . $user['no']['apell']);     // A quien le llega

          $mail->isHTML(true);    // Set email format to HTML

          $mail->Subject = 'Activación de tu cuenta';
          $mail->Body    = Func::EmailTemplate($user['no']['name'] . ' ' . $user['no']['apell'],$link);
          $mail->AltBody = 'Hola ' . $user['no']['user'] . ' para activar tu cuenta accede al siguiente elance: ' . URL . '/active/'.$e['link'];

          if(!$mail->send()) {
            $success = 0;
              $message = '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>ERROR:</strong> ' . $mail->ErrorInfo . ' </div>';
          } else {
            $this->db->insert('usuarios',$e);
            $success = 1;
            $message = 'Se ha registrado en Brains Cube. Resvise su correo para activar su cuenta.';
          }

        } else {
          $success = 0;
          if(strtolower($u[0][0]) == strtolower($user['no']['user'])) {
            $message = 'El nombre de usuario ya existe.';
          } else {
            $message = 'El email utilizado ya existe.';
          }
        }
      } else {
        $success = 0;
        $message = 'La dirección <b>' . $user['no']['email'] .'</b> no tiene un formato válido.';
      }
    } else {
      $success = 0;
      $message = 'Todos los campos deben estar llenos.';
    }

    return array('success' => $success, 'message' => $message);
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
