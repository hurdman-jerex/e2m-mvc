<?php
//date_default_timezone_set('America/Denver');
//ini_set('display_errors','1');

// get rid of the get query string
/*if( strpos($_SERVER['REQUEST_URI'],"?") ) list( $_SERVER['REQUEST_URI'], $get ) = explode( "?", $_SERVER['REQUEST_URI'] );

$uri = explode( "/", $_SERVER['REQUEST_URI'] );
$uri = array_filter( $uri );

echo '<pre>'.print_r( $get, true ).'</pre>';
echo '<pre>'.print_r( $uri, true ).'</pre>';*/

require_once "bootstrap/autoload.php";

require_once "bootstrap/start.php";
?>
