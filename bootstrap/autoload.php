<?php

function e2m_path( $dir = 'base' )
{
   $paths = require_once 'paths.php';
   return $paths[ $dir ];
}

require_once dirname( dirname(__FILE__) ).'/library/SplClassLoader.php';
require_once dirname( dirname(__FILE__) ).'/library/Router.php';

$controllerClassLoader = new SplClassLoader( "App\\Controller", e2m_path( 'controller' ) );
$controllerClassLoader->register();
?>
