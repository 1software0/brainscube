<?php

class Tkses extends Models implements OCREND {

  public $Token = false;

  //------------------------------------------------

  /**
    * Genera un Token Session id para no usar numeros de usuario
    *
    * @param  int  $data: Una distincion
    * @return string con tu Token session id
    *
    * Importante: No usar esta funcion para generar Un TOKEN se usa TSID()
    *
  */
  final public static function GenerarSID(int $data = null) : string {
    Helper::load('strings');
    if ($data !== null) {
      return Strings::encrypt_((rand(0, (1+$data)/2)*10000000000000000),$data);
    } else {
      return Strings::encrypt_(rand(0, (1+time())/2)*10000000000000000,time());
    }
  }
  //------------------------------------------------

  /**
    * Revisa si existe un Token, importante si ya expiro no existe, pero te
    * regresa la informacion
    *
    * @param string  $id: El token que se revisa
    * @return array ['0' => bolean 'existe' [,'1'=> integer 'id']]
  */
  final public static function _exist_TSID(string $id) : array {
    $db = Conexion::Start();
    $sql = $db->select("*",'sesiones',"tkid = '$id'",'LIMIT 1');
    $n = count($sql);
    if ($n == 1) {
      $n = $sql;
      if ($n[0]['deadline'] > idate('U', date('U'))) {
        return [true,$n[0][0]];
      } else {
        return [false,$n[0][0]];
      }
    } else {
      return [false];
    }
  }
  //------------------------------------------------

  /**
    * Regresa los permisos del usuario dado el tk
    *
    * @param string  $tk: El token que se revisa
    * @return integer permisos
  */
  final public static function getPbyTK(string $tk) {
    if (Tkses::_exist_TSID($tk)[0]) {
      return User::Datos('permisos');
    } else {
      return false;
    }
  }
  //------------------------------------------------

  /**
    * Le asigna un TK de session al usuario
    *
    * @param integer  $id: El token que se revisa
    * @param integer $die: La duracion de la session
    * @return array ['0' => bolean 'exito' [,'1'=> integer 'exipira', '2' => string 'TOKEN']]
  */
  final public static function TSID(int $id, integer $die = NULL) : array {
    $timestamp = date('U');
    $de = idate('U', $timestamp)+(10800);
    $deadline = ($die == NULL) ? $de : $die ;
    $tk = TKses::GenerarSID();
    $TKid = (TKses::_exist_TSID($tk)[0]) ? TKses::GenerarSID($tk) : $tk ; // evita coaliciones de TK
    $ip = $_SERVER['REMOTE_ADDR'];
    $moz = $_SERVER['HTTP_USER_AGENT'];
    $bd = Conexion::Start();
    $sql = $bd->query("INSERT INTO `sesiones` ( `Usuarios_id`, `IdUsuario`, `date`, `deadline`, `TKid`, `ip`, `brow` ) VALUES ( '$id', '$id', '$timestamp', '$deadline', '$TKid', '$ip','$moz');");
    return [true,$deadline,$TKid];
  }
  //------------------------------------------------

  /**
    * Elimina la sesion de un usuario con el TKid
    *
    * @param string  $id: El token id
    * @return boolean Se completo la operacion.
  */
  final public static function end_TSID(string $id) {
      $bd = Conexion::Start();
      $id = TKses::_exist_TSID($bd->scape($id))[1];
      $idate = idate('U', date('U'));
      $sql = $bd->query("UPDATE `sesiones` SET `end` = ' $idate ', `is_over` = '1' WHERE `sesiones`.`id` = $id");
  }

  /**
    * Da el id usuario dado su token
    *
    * @param string  $id: El token id
    * @return int el id de usuario
  */
  final public static function getUserbyTK(string $id) {
      $bd = Conexion::Start();
      $tid = $bd->select("idUsuario","sesiones","TKid='$id'","LIMIT 1");
      return $tid[0][0];
  }
  /**
    * Da los permisos del usuario dado su token
    *
    * @param string  $id: El token id
    * @return int permisos de usuarios
  */
  final public static function gePbyTK(string $id) {
      $bd = Conexion::Start();
      $tid = $bd->select("permisos","sesiones","TKid='$id'","LIMIT 1");
      return $tid[0][0];
  }
  /**
    * Da el id de sesion void
    *
    * @return int el id de sesion
  */
  final public static function getidses() {
      $bd = Conexion::Start();
      $id = $_SESSION[SESS_APP_ID];
      $tid = $bd->select("id","sesiones","TKid='$id'","LIMIT 1");
      return $tid[0][0];
  }

  public function __construct() {
    parent::__construct();
  }
  public function __destruct() {
    parent::__destruct();
  }
}
 ?>
