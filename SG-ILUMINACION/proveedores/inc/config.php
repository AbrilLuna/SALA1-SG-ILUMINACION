<?php

if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $PROTO = 'https';
}
else {
  $PROTO = 'http';
} 

$app_url = ($PROTO  )
          . "://".$_SERVER['HTTP_HOST']
          . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
          . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");

define("APPURL", $app_url);


function app_db (){
	include_once dirname(__FILE__).'/CrudDB-class.php';

    $db_conn = array(
        'host' => 'localhost', 
        'database' => 'sg_iluminacion', 
        'user' => 'root',
        'pass' => '',        
    );

    $db = new CrudDB($db_conn);
    return $db;     
}