<?php

function abort( $code )
{
    die( $code );
}

function config( $data )
{
    $_config = require_once( e2m_path( 'config' ) . 'config.php' );
    $_tmp = explode( '.', $data );
    $config = array();
    foreach( $_tmp as $i )
        $config = $_config[ $i ];
        
    return $config;
}

function dd( $obj ){
    echo '<pre>'.print_r( $obj, true).'</pre>';
}

function hurdman_query_escape($value) {

    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }
    // Escape if not integer
    if (!is_numeric($value)) {
        $value = mysql_escape_string($value);
    }
    return $value;

    //return mysql_escape_string($value);
    $return = '';
    for($i = 0; $i < strlen($value); ++$i) {
        $char = $value[$i];
        $ord = ord($char);
        if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
            $return .= $char;
        else
            $return .= '\\x' . dechex($ord);
    }
    return $return;
}
?>
