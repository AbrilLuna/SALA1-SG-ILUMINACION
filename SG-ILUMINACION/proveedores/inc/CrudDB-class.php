<?php

class CrudDB{
  public $isConn; 
  
  public $ShowQryErrors = 'on';

  //--->Coneccion - Inicio
  public function __construct( $db_conn = array('host' => 'localhost', 'user' => 'root','pass' => '','database' => 'sg_iluminacion', ) )  {
    $host = isset($db_conn['host']) ? $db_conn['host'] : 'localhost' ;
    $user = isset($db_conn['user']) ? $db_conn['user'] : 'root' ;
    $pass = isset($db_conn['pass']) ? $db_conn['pass'] : '' ;

    $database = isset($db_conn['database']) ? $db_conn['database'] : die('no database set') ;

    $connection = mysqli_connect($host, $user, $pass,$database);

    if (!$connection) {
      die("La conexión falló: " . mysqli_connect_error());
      return false;
    }
    if($connection){
      $this->isConn = $connection;
    }
  }
  //--->Coneccion - Fin

  //--->Select - Inicio
  function Select($SQLStatement){
    $con =  $this->isConn;

    if (!$con) {
      die("La conexión falló en función Select - " . mysqli_connect_error());
    }

    if ($con) {
      $q = $con->query($SQLStatement);

      if(!$q){
        if($this->ShowQryErrors == 'on'){
          die( mysqli_error($con) );  
        }        
      }

      $row = $q->num_rows;

      if($row <1){
        $result = $row;  
      }
      else if($row == 1){
        $result = array($q->fetch_assoc());
      }
      else if( $row >1){
        $d1 = array( $q->fetch_assoc());
        
        $d2= array();
        while ($row = $q->fetch_assoc()) {
          $d2[] = $row;
        }
        $result = array_merge($d1 , $d2); 
      }
      return $result;
      }
  }
  //--->Select - Fin


  //--->Insert - Inicio  
  function Insert($TableName, $row_arrays = array()  ) { 
    foreach( array_keys($row_arrays) as $key ) {
      $columns[] = "$key";
      $values[] = "'" .  $row_arrays[$key] . "'";
    }
    $columns = implode(",", $columns);
    $values = implode(",", $values);

    $sql = "INSERT INTO $TableName ($columns) VALUES ($values)";
    
    $con =  $this->isConn;

    if (!$con) {
      die("La conexión falló en función Insert - " . mysqli_connect_error());
    }

    if($con){
      $q = $con->query($sql);
      if(!$q){  
        if($this->ShowQryErrors == 'on'){
          die( mysqli_error($con) );  
        }  
        $result =  0;
      }
      if($q){
        $result =  $con->insert_id;      
      }
      
      return $result; 
    }
  }
  //--->Insert - Fin

  //--->Update - Inicio
  function Update($strTableName, $array_fields, $array_where){ 
    foreach($array_fields as $key=>$value) {
      if($key) {
        $field_update[] = " $key='$value'";
      }
    }
    $fields_update = implode( ',', $field_update );

    foreach($array_where as $key=>$value) {
      if($key) {
        $field_where[] = " $key='$value'";
      }
    }
    $fields_where = implode( ' and ', $field_where );

    $SQLStatement = "UPDATE $strTableName  SET $fields_update WHERE $fields_where ";

    $con =  $this->isConn;

    if (!$con) {
      die("La conexión falló en función Update - " . mysqli_connect_error());
    }

    if($con){
      $q = $con->query($SQLStatement);
      if(!$q){ 
        if($this->ShowQryErrors == 'on'){
          die( mysqli_error($con) );  
        } 

        $result =  0;
      }
      if($q){  
        $result = 1;
      }
      
      return $result; 
    }
  }
  //--->Update - Fin

  //--->Delete - Inicio
  function Delete($strTableName,$array_where){
    foreach($array_where as $key=>$value) {
      if($key) 
      {
        $field_where[] = " $key='$value' ";
      }
    }
    $fields_where = implode( ' and ', $field_where );

    $con =  $this->isConn;
    
    if (!$con) {
      die("La conexión falló en función Delete - " . mysqli_connect_error());
    }

    $QDeleteRec = "DELETE FROM $strTableName WHERE $fields_where";

    
    if($con){
      $q = $con->query($QDeleteRec);

      if($q){
        $result = 1;
      }
      if(!$q){   
        $result = 0;
      }
      
      return $result;
    }
  }
  //--->Delete - Fin




  function Qry($SQLStatement){
    $con =  $this->isConn;
    
    if (!$con) {
      die("La conexión falló en función Qry - " . mysqli_connect_error());
    }
    
    if($con){
      $q = $con->query($SQLStatement);
      
      if(!$q){
        if($this->ShowQryErrors == 'on')
        {
          die( mysqli_error($con) );  
        } 
        $result = 0;
      }
      if($q){       
        $result = 1;
      }
      
      return $result;
    }
  }


  function CleanDBData($Data){
    $con =  $this->isConn;
    $str = mysqli_real_escape_string($con,$Data); 
    return $str;
  } 

  function CleanHTMLData($Data){
    $con =  $this->isConn; 
    $str = mysqli_real_escape_string($con,$Data);
    
    $result = preg_replace('/(?:<|&lt;)\/?([a-zA-Z]+) *[^<\/]*?(?:>|&gt;)/', '', $str);
    
    return $result;
  } 
}
?>
