<?php

$route = new Router();

/**
* Landing Pages
* 
* @var Router
*/
$route->get( '', 'LandingController@index');

/**
* Business Pages
* 
* @var Router
*/
$route->get( 'business/general/edit/{:id}', 'BusinessController@getGeneralEditForm');

//$routerClassLoader->unregister();
return $route;
?>
