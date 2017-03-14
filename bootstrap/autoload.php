<?php

function e2m_path( $dir = 'base' )
{
   $paths = require_once 'paths.php';
   return $paths[ $dir ];
}

require __DIR__.'/../library/SplClassLoader.php';
require __DIR__.'/../library/Router.php';

$controllerClassLoader = new SplClassLoader( "App\\Controller", e2m_path( 'controller' ) );
$controllerClassLoader->register();
?>
