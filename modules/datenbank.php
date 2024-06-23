<?php
function connect_mysqli() {

  $hostname = 'db';
  $username = 'login';
  $password = 'login';
  $database = 'login_projekt';
  $port     = '3306';

  $conn = mysqli_connect($hostname, $username, $password, $database, $port);

  if (!$conn) {
    die('Connection failed: '.mysqli_connect_error());
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