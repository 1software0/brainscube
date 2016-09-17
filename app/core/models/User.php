<?php
final class User extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }


   /**
   * Ve si existe una clave de Activacion
   *
   * @param string $id: El tkid del usuario para activar
   *
   * @return boolean : Si es o no
 */
    final public static function IsactivateKey(string $id)   {
      $db = Conexion::Start();
      $id = $db->scape($id);
      $sql = $db->select('Permisos','usuarios',"link='$id'",'LIMIT 1');
      return count($sql);
    }

     /**
     * Ve si existe una clave de Activacion
     *
     * @param string $user: El usuario
     * @param string $Tid: El tkid del usuario para activar
     *
     * @return boolean : Si es o no
   */
      final public static function IsUser_key(string $user, string $Tid) {
        $bd = Conexion::Start();
        Helper::load('Strings');
        $user = Strings::encrypt_($bd->scape($user));
        $Tid = $bd->scape($Tid);
        $sql = $bd->select('Permisos','usuarios',"link='$Tid' AND user='$user'",'LIMIT 1');
        return count($sql);
      }

      /**
      * Ve si existe una clave de Activacion
      *
      * @param string $id: El usuario para activar
      *
      * @return boolean : Hubo exito en la operacion
    */
       final public static function Active(string $user)  {
         $bd = Conexion::Start();
         Helper::load('Strings');
         $user = Strings::encrypt_($bd->scape($user));

         $bd->update('usuarios',array('active'=>'1','link'=>''),"user='$user'") or die($bd->Error());
         return true;
       }

       /**
       * Ve si esta activa una sesion
       *
       *
       * @return boolean : Hubo exito en la operacion
     */
        final public static function getpermisos()  {
          $db = Conexion::Start();
          $t = $db->scape($_SESSION[SESS_APP_ID]);
          return Tkses::getPbyTK($t);
        }

       /**
       * Regresa los datos del usuario logueado
       *
       * @param string $wt : Que dato se quiere
       *
       * @return bool : los datos del usuario desenciptados
     */
        final public static function Datos(string $wt = NULL, int $id = NULL)  {
          $id = ($id === NULL) ? Tkses::getUserbyTK($_SESSION[SESS_APP_ID]) : $id;
          $db = Conexion::Start();
          Helper::load('Strings');

          $name = '';
          $namec = '';
          $ape = '';
          $mail = '';
          $user = '';
          $CP = '';
          $addr = '';
          $per = 0;

          $con = $db->select('permisos','usuarios',"id='$id'",'LIMIT 1');

          switch ($wt) {
            case 'Nombrec':
              if ($con != false) {
                $sql_a = $db->select('`Nombre`, `Apellido`','usuarios',"id='$id'",'LIMIT 1');
                $namec = Strings::decrypt_($sql_a[0][0])." ".Strings::decrypt_($sql_a[0][1]);
              }
              break;
            case 'Nombre':
              if ($con != false) {
                $sql_a = $db->select('`Nombre`, `Apellido`','usuarios',"id='$id'",'LIMIT 1');
                $name = Strings::decrypt_($sql_a[0][0]);
              }
              break;
            case 'Apellido':
              if ($con != false) {
                $sql_a = $db->select('`Nombre`, `Apellido`','usuarios',"id='$id'",'LIMIT 1');
                $ape = Strings::decrypt_($sql_a[0][1]);
              }
            break;
            case 'Correo':
                if ($con != false) {
                  $sql_b = $db->select('Correo','usuarios',"id='$id'",'LIMIT 1');
                  $mail = Strings::decrypt_($sql_b[0][0]);
                }
              break;
              case 'user':
                  if ($con != false) {
                    $sql_c = $db->select('user','usuarios',"id='$id'",'LIMIT 1');
                    $user = Strings::decrypt_($sql_c[0][0]);
                  }
              break;
              case 'zc':
                  if ($con != false) {
                    $sql_d = $db->select('zc','usuarios',"id='$id'",'LIMIT 1');
                    $CP = $sql_d[0][0] + 0;
                  }
              break;
              case 'address':
                  if ($con != false) {$sql_e = $db->select('address','usuarios',"id='$id'",'LIMIT 1');
                    $sql_e = $db->select('address','usuarios',"id='$id'",'LIMIT 1');
                    $addr = Strings::decrypt_(Strings::decrypt_($sql_e[0][0].''));
                  }
              break;
            case 'permisos':
            if ($con != false) {
              $per = $con[0][0];
            }
              break;

            default:
              if ($con != false) {
                $sql_t = $db->select('*','usuarios',"id='$id'",'LIMIT 1');
                $name = Strings::decrypt_($sql_t[0][1]);
                $ape = Strings::decrypt_($sql_t[0][2]);
                $mail = Strings::decrypt_($sql_t[0][4]);
                $user = Strings::decrypt_($sql_t[0][3]);
                $CP = $sql_t[0][8]+0;
                $per = $con[0][0];
                $addr = Strings::decrypt_(Strings::decrypt_($sql_t[0][9].''));
              }
              break;
          }
          $user = ['permisos'=>$per,'Nombrec' => $namec,'Nombre' => $name, 'Apellido' => $ape, 'Correo' => $mail, 'user' => $user, 'zc' => $CP, 'address' => $addr];

          return $user;

        }

        /**
        * Cambia datos del usuario
        *
        * @param array $data : Los datos que se van a cambiar
        *
        * @return array : Si hubo exito o un mensaje de error
        */
        final public function Update(array $data) : array {
        $bd = Conexion::Start();
        Helper::load('Strings');
        $new = '';

        if ($_SESSION['token'] != $data['token']) {
          unset($_SESSION['token']);
          return array('success' => '0', 'message' => 'No se pudo procesar la solicitud intentalo de nuevo.');
          exit;
        }
        unset($_SESSION['token']);

        switch ($data['w']) {
          case 'a':
            $name = Strings::encrypt_($bd->scape($data['Nombre']));
            $apell = Strings::encrypt_($bd->scape($data['Apellido']));
            $mail = Strings::encrypt_($bd->scape($data['Correo']));
            $user = Strings::encrypt_($bd->scape($data['user']));

            if (Func::all_full($data)) {
              $u = $this->db->select('id,pass','usuarios',"user='$user'",'LIMIT 1');
              if(false != $u and Strings::chash($u[0][1],$data['pass'])) {
                $e = array('Apellido' => $apell, 'Nombre' => $name, 'Correo' => $mail);
                $id = $u[0][0];
                $bd->update('usuarios',$e,"id='$id'");
                $success = 1;
                $message = 'Se han guardado los cambios';
                $new = array('0' => Strings::decrypt_($name), '1' => Strings::decrypt_($apell), '2' => Strings::decrypt_($mail) );
              } else {
                $success = 0;
                $message = 'La contraseña no coincide';
              }
            } else {
              $success = 0;
              $message = 'No ha llenado todos los datos';
            }
            break;

            case 'b':
            if (Func::all_full($data)) {
              $user = Strings::encrypt_($bd->scape($data['user']));
              $u = $this->db->select('id,pass','usuarios',"user='$user'",'LIMIT 1');
              if(false != $u and Strings::chash($u[0][1],$data['pass'])) {
                if (!($data['pass'] === $data['new_pass']) and ($data['new_pass'] === $data['new_pass_2'])) {
                  $e = array('pass' => Strings::hash($data['new_pass']));
                  $id = $u[0][0];
                  $bd->update('usuarios',$e,"id='$id'");
                  $success = 1;
                  $message = 'Se han guardado los cambios';
                } else {
                  if ($data['pass'] === $data['new_pass']) {
                    $success = 0;
                    $message = 'La contraseña no puede ser la misma que la anterior';
                  } else {
                    $success = 0;
                    $message = 'La contraseñas no coinciden';
                  }
                }
              } else {
                $success = 0;
                $message = 'La contraseña no coincide';
              }
            } else {
              $success = 0;
              $message = 'No ha llenado todos los datos';
            }
            break;

            case 'c':
              $user = Strings::encrypt_($bd->scape($data['user']));
              if (Func::all_full($data)) {
                $u = $this->db->select('id,pass','usuarios',"user='$user'",'LIMIT 1');
                if(false != $u and Strings::chash($u[0][1],$data['pass'])) {
                  $id = $u[0][0];
                    $e = array('address' => Strings::encrypt_(Strings::encrypt_($data['address'])), 'zc' => $data['zc']);
                    $bd->update('usuarios',$e,"id='$id'");
                    $success = 1;
                    $message = 'Los datos se han guardado';
                    $new = array('0' => $data['address'], '1' => $data['address']);
                } else {
                  $success = 0;
                  $message = 'La contraseña no coincide';
                }
              } else {
                $success = 0;
                $message = 'No ha llenado todos los datos';
              }
              break;

              case 'd':
              $user = Strings::encrypt_($bd->scape($data['user']));
              $u = $this->db->select('id,pass','usuarios',"user='$user'",'LIMIT 1');

                if(false != $u and Strings::chash($u[0][1],$data['pass'])) {
                  $this->db->update('usuarios', array('address' => '', 'zc' => 0),"user = '$user'");
                  $success = 1;
                  $message = 'Se ha borrado su dirrección.';
                  $new = array('0' => '', '1' => '');
                } else {
                  $success = 0;
                  $message = 'La contraseña no coincide';
                }
                break;

          default:
            $success = 0;
            $messaje = 'No se encontró la petición';
            break;
        }

        return array('success' => $success, 'message' => $message, 'new' => $new);

        }

        /**
        * Ve si existe una clave de cambio de contraseña
        *
        * @param string $key: la clave
        *
        * @return boolean : hay o no
      */
         final public static function is_pass_key(string $key)  {
           $bd = Conexion::Start();
           $ke = $bd->scape($key);
           $u = $bd->select('keypass_tmp','usuarios',"keypass = '$ke'",'LIMIT 1');
           $n = idate('U', date('U'));
           if ($u != false and $n <= $u[0][0]) {
             return true;
           } else {
             return false;
           }
         }
         /**
         * Dada una clave de restablecer contraseñña de usuario
         *
         * @param string $key: La clave de reeestablecer contraseña
         *
         * @return string : el nombre de usuario
       */
          final public static function getUserby_passkey(string $key)  {
            $bd = Conexion::Start();
            $ke = $bd->scape($key);
            $u = $bd->select('user','usuarios',"keypass = '$ke'",'LIMIT 1');
            if ($u != false) {
              return $u[0][0];
            } else {
              return false;
            }

          }
         /*
          * Reestablece la contraselña de un usuario
          *
          * @param string $key: La clave de reeestablecer contraseña
          * @param string $pas: La contraseña

          *
          * @return bool : si tuvo exito la operacion
          */
           final public static function Reset_pass(string $key, string $pas)  {
             Helper::load('Strings');
             $bd = Conexion::Start();
             $ke = $bd->scape($key);
             $pa = $bd->scape($pas);
             $user = Strings::encrypt_(User::getUserby_passkey($ke));
             $e = array('pass' => $pa, 'keypass' => '', 'keypass_tmp' => '');
             $u = $bd->update('usuarios',$e,"keypass='$ke'") or die($bd->error());
             return true;
           }


  public function __destruct() {
    parent::__destruct();
  }

}
?>
