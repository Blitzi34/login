<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
session_handler();

$funktion = (isset($_POST['funktion'])) ? ($_POST['funktion']) : ( isset($_GET['funktion']) ? ($_GET['funktion']) : '');

switch ($funktion) {

    case 'logout':
        echo json_encode(logout());
        exit;

    case 'check_template_exists':

        $template['template_file'] = $_SERVER['DOCUMENT_ROOT'].'/templates/'.$_POST['template'].'.php';

        if (!file_exists($template['template_file'])) {
            echo json_encode(false);
            exit;
        }

        if (file_exists($template['template_file'])) {
            echo json_encode(true);
            exit;
        }
}



function session_handler() {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
  
    if (isset($_SESSION['loggedin'])) { 
 
        $time_now                   = time();
        $minutes_to_expire          = 60;

        if (!isset($_SESSION['session_start']) || !isset($_SESSION['session_expire'])) {
            $_SESSION['session_start']  = $time_now;
            $_SESSION['session_expire'] = $_SESSION['session_start'] + ($minutes_to_expire * 60);
        }

        if (isset($_SESSION['session_expire']) && $_SESSION['session_expire'] < $time_now ) { 
            logout();
            return 'logged_out';
        } 

        $_SESSION['session_expire'] = $_SESSION['session_start'] + ($minutes_to_expire * 60);
        $_SESSION['session_start']  = $time_now;
    } 
  
    return 'session_ok';
}



function logout() {

    session_unset();
    return true;
}
?>