<?php
  
  include 'ClientInterface.php';
  
  class Client implements ClientInterface {
      
      protected $route;
      protected $router;
      protected $controller;
      protected $app;
      
      public function setApp( e2mobile $app ){
          $this->app = $app;
      }
      
      public function getApp()
      {
          $this->app;
      }
      
      public function setRoute( Router $route )
      {
          $this->route = $route;
      }
      
      public function getRoute()
      {
          return $this->route;
      }
      
      public function mapRoute()
      {
          return $this->router = $this->route->match( $_SERVER, $_REQUEST );
      }
      
      public function setController( $controller )
      {
          $this->controller = $controller;   
      }
      
      public function getController()
      {
          return $this->controller->{ $this->router['method'] }( $this->router['args'] );
      }
      
      public function handle()
      {
          return $this->getController();
          //return call_user_func(array($this->app['controller'], $this->app['method']), $this->app['args']);
      }
      
      public function invoke()
      {
          return $this->handle();
      }
  }
?>
