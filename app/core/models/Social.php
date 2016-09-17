<?php

final class Social extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  final public function Foo(array $data) : array {
    $params = array();
    $params['secret'] = '6LfI_iQTAAAAAI0dkRH76nCSKrGBpLuzeBp6SY9e'; // Secret key
    if (!empty($data) && isset($data['response'])) {
        $params['response'] = urlencode($data['response']);
    }
    $params['remoteip'] = $_SERVER['REMOTE_ADDR'];

    $params_string = http_build_query($params);
    $requestURL = 'https://www.google.com/recaptcha/api/siteverify?' . $params_string;

    $s = file_get_contents($requestURL);

    $response = @json_decode($s, true) or die('No se pudo descifrar la informacion: '.json_last_error());

    if ($response["success"] == true) {
      $_SESSION['robot'] = false;
          return array('success' => 1, 'message' => '');
    } else {
      $_SESSION['robot'] = true;
          return array('success' => 0, 'message' => '');
    }
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
