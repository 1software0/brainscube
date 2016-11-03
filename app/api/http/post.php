<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

/*
$app->post('/example',function($request, $response){

  $e = new Example;
  $response->withJson($e->Foo($_POST));

  return $response;
});
*/

//------------------------------------------------

/**
  * Registro de un usuario
  * @return Devuelve un json con información acerca del éxito o posibles errores.
*/
$app->post('/register',function($request, $response){

  $reg = new Register();
  $response->withJson($reg->SignUp($_POST));

  return $response;
});

//------------------------------------------------

/**
  * Inicio de Sesión
  * @return Devuelve un json con información acerca del éxito o posibles errores.
*/
$app->post('/login',function($request, $response) {

  $login = new Login();
  $response->withJson($login->SignIn($_POST));

  return $response;
});
/**
	* Procesa la edicion de los datos del usuario
	* @return Devuelve un json con información acerca del éxito o posibles errores.
*/
$app->post('/account',function($request, $response) {

	$model = new User;
	$response->withJson($model->Update($_POST));

	return $response;
});

/**
	* reesyablecee la contraseña de un usuario
  * @return Devuelve un json con información acerca del éxito o posibles errores.
*/
$app->post('/lostpass',function($request, $response) {

	$model = new Lostpass;
	$response->withJson($model->Reset_pass($_POST));

	return $response;
});
/**
	* ¿que hace (el modelo que se invoca desde aqui)?
	* @return ¿que retorna?, ¡un json por favor!
*/
$app->post('/tienda',function($request, $response) {

	$model = new Tienda;
	$response->withJson($model->Foo($_POST));

	return $response;
});

/**
	* ¿que hace (el modelo que se invoca desde aqui)?
	* @return ¿que retorna?, ¡un json por favor!
*/
$app->post('/social',function($request, $response) {

	$model = new Social;
	$response->withJson($model->Foo($_POST));

	return $response;
});
/**
	* ¿que hace (el modelo que se invoca desde aqui)?
	* @return ¿que retorna?, ¡un json por favor!
*/
$app->post('/review',function($request, $response) {

	$model = new Review;
	$response->withJson($model->Foo($_POST));

	return $response;
});
/**
	* Agrega a wishlist del usuario
	* @return Regresa un JSON de el estado de la peticion
*/
$app->post('/wishlistadd',function($request, $response) {

	$model = new Wishlist;
	$response->withJson($model->Agregar($_POST));

	return $response;
});
/**
	* Elimina un producto de wishlist del usuario
	* @return Regresa un JSON de el estado de la peticion
*/
$app->post('/wishlistdelete',function($request, $response) {

	$model = new Wishlist;
	$response->withJson($model->Eliminar($_POST));

	return $response;
});
/**
	* Añadir al carro
	* @return un json con los datos de la operacion
*/
$app->post('/carroadd',function($request, $response) {

	$model = new Carro;
	$response->withJson($model->agregar_producto($_POST));

	return $response;
});
/**
	* Quitar del carrito
	* @return un json con los datos de la operacion
*/
$app->post('/carrodelete',function($request, $response) {

	$model = new Carro;
	$response->withJson($model->quitar_producto($_POST));

	return $response;
});
