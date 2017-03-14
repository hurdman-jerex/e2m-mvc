<?php

class Router{

protected $routes = array(
    'GET'    => array(),
    'POST'   => array(),
    'ANY'    => array(),
    'PUT'    => array(),
    'DELETE' => array()
);

public $patterns = array(
    ':any'  => '.*',
    ':id'   => '[0-9]+',
    ':slug' => '[a-z\-]+',
    ':name' => '[a-zA-Z]+',
);

const REGVAL = '/({:.+?})/';    

public function any($path, $handler){
    $this->addRoute('ANY', $path, $handler);
}

public function get($path, $handler){
    $this->addRoute('GET', $path, $handler);
}

public function post($path, $handler){
    $this->addRoute('POST', $path, $handler);
}

public function put($path, $handler){
    $this->addRoute('PUT', $path, $handler);
}

public function delete($path, $handler){
    $this->addRoute('DELETE', $path, $handler);
}

protected function addRoute($method, $path, $handler){
    array_push($this->routes[$method], array( $path => $handler ));
}

public function match(array $server = array(), array $post){
    $requestMethod = $server['REQUEST_METHOD'];
    $requestUri    = $server['REQUEST_URI'];
    
    $requestUri = str_replace( '/'.config( 'base_name' ).'/', '', $requestUri );

    $restMethod = $this->getRestfullMethod($post); 

    #@TODO: Implement REST method. 

    if (!$restMethod && !in_array($requestMethod, array_keys($this->routes))) {
        return FALSE;
    }

    //$method = $restMethod ?: $requestMethod;
    $method = $requestMethod;
    
    foreach ($this->routes[$method]  as $resource) {

        $args = array(); 
        $route   = key($resource); 
        $handler = reset($resource);
        
        //echo $requestUri;
        if(preg_match(self::REGVAL, $route)){
            list($args, $uri, $route) = $this->parseRegexRoute($requestUri, $route);  
        }

        if(!preg_match("#^$route$#", $requestUri)){
            unset($this->routes[$method]);
            continue ;
        }

        if(is_string($handler) && strpos($handler, '@')){
            list($ctrl, $method) = explode('@', $handler); 
            return array('controller' => $ctrl, 'method' => $method, 'args' => $args);
        }

        if(empty($args)){
            return $handler(); 
        }
        
        #TODO: pass app by func array_push($args, $this);
         return call_user_func_array($handler, $args);

      }

      return array( 'error' => true, 'code' => '404', 'msg' => 'Page Not Found!' );
      //header('HTTP/1.1 404');
 }

protected function getRestfullMethod($postVar){
    if(array_key_exists('_method', $postVar)){
        if(in_array($method, array_keys($this->routes))){
            return $method;
        }
    }
} 

protected function parseRegexRoute($requestUri, $resource){
    
    $route = preg_replace_callback(self::REGVAL, array( $this, 'parseRegexRouteCallback' ), $resource);

    $regUri = explode('/', $resource); 
    
    $args = array_diff(
                $this->_array_replace($regUri, 
                explode('/', $requestUri)
            ), $regUri
        );  

    return array( array_values($args), $resource, $route ); 
}

protected function _array_replace( $a1, $a2 )
{
    foreach( $a1 as $i => $a )
        if( isset( $a2[ $i ] ) )
            $a1[ $i ] = $a2[ $i ];
            
    return $a1;
}
protected function parseRegexRouteCallback( $matches )
{
     $patterns = $this->patterns; 
     $matches[0] = str_replace( array( '{', '}' ), '', $matches[0]);

     if(in_array($matches[0], array_keys($patterns))){                       
        return  $patterns[$matches[0]];
     }
}
}
