<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

final class Func {

  /**
    * Calcula el porcentaje de una cantidad
    *
    * @param int $por: El porcentaje a evaluar, por ejemplo 1, 20, 30 % sin el "%", sólamente el número
    * @param int $n: El número al cual se le quiere sacar el porcentaje
    *
    * @return int con el porcentaje correspondiente
  */
  final public static function percent(int $por, int $n) : int {
    return $n * ($por / 100);
  }

  //------------------------------------------------

  /**
    * Da unidades de peso a un integer según sea su tamaño asumida en bytes
    *
    * @param int $size: Un entero que representa el tamaño a convertir
    *
    * @return string del tamaño $size convertido a la unidad más adecuada
  */
  final public static function convert(int $size) : string {
      $unit = array('bytes','kb','mb','gb','tb','pb');
      return round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
  }

  //------------------------------------------------

  /**
    * Redirecciona a una URL
    *
    * @param string $url: Sitio a donde redireccionará
    *
    * @return void
  */
  final public static function redir(string $url = URL) {
    header('location: ' . $url);
  }

  //------------------------------------------------

  /**
    * Aanaliza que TODOS los elementos de un arreglo estén llenos, útil para analizar por ejemplo que todos los elementos de un formulario esté llenos
    * pasando como parámetro $_POST
    *
    * @param array $array, arreglo a analizar
    *
    * @return true si están todos llenos, false si al menos uno está vacío
  */
  final static function all_full(array $array) : bool {
    foreach($array as $e) {
      if(empty($e) and $e != '0') {
        return false;
      }
    }
    return true;
  }

  //------------------------------------------------

  /**
    * Retorna la URL de un gravatar, según el email
    *
    * @param string  $email: El email del usuario a extraer el gravatar
    * @param int $size: El tamaño del gravatar
    * @return string con la URl
  */
   final public static function get_gravatar(string $email, int $size = 32) : string  {
       return 'http://www.gravatar.com/avatar/' . md5($email) . '?s=' . (int) abs($size);
   }
   //------------------------------------------------

   /**
     * Retorna la informacion de Ubicacion de IP de un usuario.
     *
     * @param string  $ip: La ip del usuario
     * @param string $purpose: Los datos que va a regresar
     * @param boolean $deep_detect: Que tan especifico
     * @return mixed con los datos que se piden -> "location" -> Array "else"->string
   */
   final public static function ip_info(string $ip = NULL, string $purpose = NULL, boolean $deep_detect = NULL) {
       $output = NULL;
       if ($purpose === NULL) {
         $purpose = "location";
       }
       if ($deep_detect === NULL) {
         $deep_detect = true;
       }
       if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
           $ip = $_SERVER["REMOTE_ADDR"];
           if ($deep_detect) {
               if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
               if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                   $ip = $_SERVER['HTTP_CLIENT_IP'];
           }
       }
       $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
       $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
       $continents = array(
           "AF" => "Africa",
           "AN" => "Antarctica",
           "AS" => "Asia",
           "EU" => "Europe",
           "OC" => "Australia (Oceania)",
           "NA" => "North America",
           "SA" => "South America"
       );
       if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
           $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
           if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
               switch ($purpose) {
                   case "location":
                       $output = array(
                           "city"           => @$ipdat->geoplugin_city,
                           "state"          => @$ipdat->geoplugin_regionName,
                           "country"        => @$ipdat->geoplugin_countryName,
                           "country_code"   => @$ipdat->geoplugin_countryCode,
                           "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                           "continent_code" => @$ipdat->geoplugin_continentCode
                       );
                       break;
                   case "address":
                       $address = array($ipdat->geoplugin_countryName);
                       if (@strlen($ipdat->geoplugin_regionName) >= 1)
                           $address[] = $ipdat->geoplugin_regionName;
                       if (@strlen($ipdat->geoplugin_city) >= 1)
                           $address[] = $ipdat->geoplugin_city;
                       $output = implode(", ", array_reverse($address));
                       break;
                   case "city":
                       $output = @$ipdat->geoplugin_city;
                       break;
                   case "state":
                       $output = @$ipdat->geoplugin_regionName;
                       break;
                   case "region":
                       $output = @$ipdat->geoplugin_regionName;
                       break;
                   case "country":
                       $output = @$ipdat->geoplugin_countryName;
                       break;
                   case "countrycode":
                       $output = @$ipdat->geoplugin_countryCode;
                       break;
               }
           }
       }
       return $output;
   }
   //------------------------------------------------

   /**
     * Hace una plantilla para mandar un correo de registro del usuario
     *
     * @param string  $user: El nombre del usuario
     * @param string $link: El link para la activacion de la cuenta
     * @return string con elmensaje
   */
   final public static function EmailTemplate(string $user,string $link) : string {
     $HTML = '
     <html>
     <body style="background: #FFFFFF;font-family: Verdana; font-size: 14px;color:#1c1b1b;">
     <div style="">
         <h2>Hola '.$user.'</h2>
         <p style="font-size:17px;">Gracias por registrarte en '. APP.'.</p>
     	<p>Solo queda un paso más, activar tu cuenta para disfrutar de todos los beneficios de un usuario registrado.</p>
     	<p style="padding:15px;background-color:#ECF8FF;">
     			Para activar tu cuenta por favor has <a style="font-weight:bold;color: #2BA6CB;" href="'.$link.'" target="_blank">clic aquí &raquo;</a>
     	</p>
         <p style="font-size: 9px;">&copy; '. date('Y',time()) .' '.APP.'. Todos los derechos reservados.</p>
     </div>
     </body>
     </html>
     ';

         return $HTML;
   }



}

?>
