<?php
require_once dirname(__FILE__).'/../App/helpers.php';
require_once dirname(__FILE__).'/../App/Mobile/Client.php';

$app = new Client();

$app->setRoute( require_once dirname(__FILE__).'/../App/routes.php' );

$response = $app->mapRoute();

if( isset( $response['error'] ) )
    abort( $response['code'] );

$app->setController( new $response['controller']() );

// Now run the app
$app->invoke();
?>
