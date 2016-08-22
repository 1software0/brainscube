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
