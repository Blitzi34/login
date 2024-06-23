<?php

function connect_mysqli() {

  // $args = [
  //   'hostname' => 'localhost',
  //   'username' => 'admin',
  //   'password' => 'admin'
  //   // 'database' => 'login_projekt',
  //   // 'port'     => '3306'
  // ];

  // $args = sprintf("'%s'", implode("', '", $args));

  // $conn = mysqli_connect($args);

  $hostname = 'db';
  $username = 'login';
  $password = 'login';
  $database = 'login_projekt';
  // $port     = '3306';
  echo 'TEST';

  $conn = mysqli_connect($hostname, $username, $password, $database);

  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }
  return $conn;
}

  if (!defined('DBLINK')) {
    define('DBLINK', 'connect_mysqli');
  }
  
  if (!isset($GLOBALS[DBLINK]) || is_resource($GLOBALS[DBLINK]) === FALSE) {
    $GLOBALS[DBLINK] = connect_mysqli();
  }

?>