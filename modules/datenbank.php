<?php

function connect_mysqli() {
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    
    $conn = mysqli_connect($servername, $username, $password);
    
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

if (!defined('DBLINK')) {
  define('DBLINK', 'conn_mysqli');
}


if (!isset($GLOBALS[DBLINK]) || is_resource($GLOBALS[DBLINK]) === FALSE) {
    $GLOBALS[DBLINK] = connect_mysqli();
}

?>