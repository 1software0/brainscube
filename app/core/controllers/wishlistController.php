<?php

class wishlistController extends Controllers {

  public function __construct() {
    parent::__construct(true,false);

    if (isset($_SESSION['app_id'])) {
      $user =  User::Datos('Nombrec');
    } else {
      $user = false;
    }

    $_SESSION['wishlist_wh'] = $_SERVER['REQUEST_URI'];

    $wishlist = Wishlist::getUserWishlist();

    echo $this->template->render('wishlist/wishlist', array('data_header' => array('url' => '',
    'nombre' => 'Lista de deseos',
    'user' => $user,
    'carro' => false
  ),
    'data_info' => array(
      'nombre' => 'Lista de deseos',
      'name_min' => 'wishlist'
    ),
    'tienda' => $wishlist
  )
    );
  }

}

?>
