<?php

class logoutController extends Controllers {

  public function __construct() {
    parent::__construct(true);
    Tkses::end_TSID($_SESSION[SESS_APP_ID]);
    unset($_SESSION[SESS_APP_ID]);
    unset($_SESSION['user']);
    session_write_close();
    session_unset();
    Func::redir();
  }

}

?>
