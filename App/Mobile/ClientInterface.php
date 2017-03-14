<?php
  
  interface ClientInterface {
      
      public function handle();
      public function setApp( e2mobile $app );
      public function setRoute( Router $router );
      public function setController( $controller );
      public function getController();
      public function mapRoute();
  }
?>
