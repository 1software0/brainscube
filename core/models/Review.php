<?php

final class Review extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  final public function Foo(array $data) : array {
    if (Func::all_full($data)) {
      $h = new Social();
      Helper::load('Strings');
      if ($h->Foo(array('response' => $data['response']))['success'] and $_SESSION["token"] == $data['token']) {
        $ses_id = Tkses::getidses();
        $user_id = Tkses::getUserbyTK($_SESSION[SESS_APP_ID]);
        $id_pro = Articulo::getIdbyLink($data['url']);
        $coment = $this->db->quote(Strings::getBadwords(Strings::bbcode($this->db->scape($data['text']))));
        $date = idate('U', date('U'));
        $rate = $this->db->scape($data["rating"]);

        $e = array( 'Sesiones_id' => $ses_id , 'Usuarios_id' => $user_id, 'idusuario' => $user_id, 'comentario' => $coment, 'date' => $date, 'rate' => $rate, 'idses' => $ses_id, 'id' => $id_pro);

        $query = "INSERT INTO `review` (";
        $values = '';
        foreach ($e as $campo => $v) {
          $query .= '`'. $campo . '`' . ',';
          $values .= '\'' . $v . '\',';
        }
        $query[strlen($query) - 1] = ')';
        $values[strlen($values) - 1] = ')';
        $query .= ' VALUES (' . $values . ';';

        $this->db->query($query);
        unset($_SESSION['token']);
        return array('success' => 1, 'message' => 'Se ha registrado tu reseña. Gracias');
      } elseif ($_SESSION["token"] != $data['token']) {
        unset($_SESSION['token']);
        return array('success' => 0, 'message' => 'No pudimos verificar que seas humano intentalo de nuevo.');
      } else {
        unset($_SESSION['token']);
        return array('success' => 0, 'message' => 'No se pudo completar la acción intentalo de nuevo.');
      }
    } else {
      unset($_SESSION['token']);
      return array('success' => 0, 'message' => 'Tienes que llenar todos los campos.');
    }
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
