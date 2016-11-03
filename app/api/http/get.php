<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

/*
$app->get('/example',function($request, $response){

  $e = new Example;
  $response->withJson($e->Foo($_GET));

  return $response;
});
/**
	* regresa la busqueda de productos
	* @return json con la preview de la busqueda
*/
$app->get('/search',function($request, $response) {

	$model = new Search;
	$response->withJson($model->Foo($_GET));

	return $response;
});

/**
	* Ve los articulos del carrito
	* @return un json con los datos del carrito
*/
$app->get('/products_car',function($request, $response) {

	$model = new Carro;
	$response->withJson($model->get_car_products($_GET));

	return $response;
});
