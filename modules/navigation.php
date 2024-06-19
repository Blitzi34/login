<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$funktion = (isset($_POST['funktion']))  ? ($_POST['funktion']) : ( isset($_GET['funktion']) ? ($_GET['funktion']) : '');

switch ($funktion) {

    case 'logout':
    
        session_unset();
        echo json_encode(true);
        exit;
    }

?>