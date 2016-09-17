<?php

class tiendaController extends Controllers {

  public function __construct() {
    parent::__construct();

    //iniciando valores de variable
    $router = new Router;
    $store = new Store;
    $query = NULL;
    $order_by = NULL;
    $ru = $_SERVER['REQUEST_URI'];
    $token = Tkses::GenerarSID(rand(101010101,238269867));
    $_SESSION['token'] = $token;

    //llamando helpers y creando rutas
    Helper::load('Bootstrap');
    Helper::load('Strings');
    $this->route->setRoute('/pag','int');
    $this->route->setRoute('/producto','alphanumeric');

    //verificando si el usuario esta logueado
    if (isset($_SESSION['app_id'])) {
      $user =  User::Datos('Nombrec');
    } else {
      $user = false;
    }

    //verificando los valores de las variables get
    if (isset($_GET['s'])) {
      $l = $_GET['s'];
      $size = $_GET['s'];
    } else {
      $size = 12;
      $l = NULL;
    }
    if (isset($_GET['q'])) {
      $query = $_GET['q'];
    }
    if (isset($GET['o'])) {
      $order_by = $GET['o'];
    }
    $min_p = (isset($GET['min'])) ? $GET['min'] : NULL;
    $max_p = (isset($GET['max'])) ? $GET['max'] : NULL;
    $marca = (isset($_GET['marca'])) ? $_GET['marca'] : NULL;
    $categoria = (isset($_GET['categoria'])) ? $_GET['categotia'] : NULL;
    $tag = (isset($_GET['tags'])) ? $_GET['tags'] : NULL;
    $amper = (isset($_GET['s']) or isset($_GET['q']) or isset($GET['min']) or isset($GET['max']) or isset($_GET['marca']) or isset($_GET['categoria']) or isset($_GET['color']) or isset($_GET['tags'])) ? '&' : '?' ;

    switch ($router->getMethod()) {

      case 'pag':
      //si la request no es valida redirige a pagina valida
      if ($router->getId() !== abs($router->getId())) {
        Func::redir(__ROOT__."tienda/");
      }

      $pages = ($router->getId() - 1);
      $t = Store::total();
      $start = $pages*$size;
      $limit = min(($t - $start),$size);
      $l = ($limit+($size*($pages)));

      // se hace la consulta de la query y se recolectan los datos para muestreo al usuario
      $store->getProducts($query,$order_by,$l,$start);
      $store->getAttrib();

      $prices = $store->procesPrices();
      $paginas_totales = ceil($store->total_p/$size);
          $config = array(
        'anterior' => '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
        'siguiente' => '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
        'i' => 5,
        'd' => 5
      );

      echo $this->template->render('tienda/tienda', array('data_header' => array('url' => '?continue='.$ru,
      'nombre' => 'Tienda',
      'user' => $user,
      'carro' => false
    ),
      'data_info' => array(
        'nombre' => 'tienda',
        'name_min' => 'tienda'
      ),
      'store' => $store,
      'link' => 'tienda/pag/',
    'pag' => ($pages+1),
    'paginas_totales' => $paginas_totales,
    'config' => $config,
    'limit' => $l,
    'start' => $start,
    'size' => $size,
    'prices' => $prices,
    'url' => $ru,
    'amp' => $amper
    )
      );

        break;

      case 'producto':
        if ($router->getId() != '') {

          $art = new Articulo();
          $t = Articulo::getIdbyLink($router->getId()) or Func::redir(__ROOT__."tienda/");
          $art->_gp_($t);
          $db = Conexion::Start();
          $user_id = (isset($_SESSION['app_id'])) ? Tkses::getUserbyTK($_SESSION[SESS_APP_ID]) : 0;
          $co = (isset($_SESSION['app_id'])) ? ($db->select('idusuario','review',"idusuario='$user_id' and id='$t'",'LIMIT 1')[0][0] == $user_id) : false ;

          echo $this->template->render('tienda/producto', array('data_header' => array('url' => '?continue='.$ru,
          'nombre' => 'Tienda',
          'user' => $user,
          'carro' => false
        ),
          'data_info' => array(
            'nombre' => $art->titulo,
            'name_min' => 'producto | '.$art->titulo
          ),
          'producto' => $art,
          'url' => $router->getId(),
          'posteado' =>  $co,
          'token' => $token
      )
    );
        } else {
          Func::redir(__ROOT__."tienda/");
        }
        break;

      default:
      if (isset($_GET['q'])) {
        $query = $_GET['q'];
      }

      $store->getProducts($query);

      $pages = 0;

      $page = 1;
      $start = 0;
      $limit = min($store->total_p,$size);
      $l = ($limit+($size*($page-1)));

      //preparando la vista
      $prices = $store->procesPrices();
      $paginas_totales = ceil($store->total_p/$size);
          $config = array(
        'anterior' => '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
        'siguiente' => '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
        'i' => 5,
        'd' => 5
      );
      echo $this->template->render('tienda/tienda', array('data_header' => array('url' => '?continue='.$ru,
      'nombre' => 'Tienda',
      'user' => $user,
      'carro' => false
    ),
      'data_info' => array(
        'nombre' => 'tienda',
        'name_min' => 'tienda'
      ),
      'store' => $store,
      'link' => 'tienda/pag/',
    'pag' => ($pages+1),
    'paginas_totales' => $paginas_totales,
    'config' => $config,
    'limit' => $l,
    'start' => $start,
    'size' => $size,
    'prices' => $prices,
    'url' => $ru,
    'amp' => $amper
    )
      );
        break;

    }

  }

}

?>
