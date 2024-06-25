<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
session_handler();

$funktion = (isset($_POST['funktion'])) ? ($_POST['funktion']) : ( isset($_GET['funktion']) ? ($_GET['funktion']) : ('') );

switch ($funktion) {

    case 'login':
        $error = [];

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Bitte eine gültige Email-Adresse eingeben.';
            echo json_encode($error);
            exit;
        }

        include_once($_SERVER['DOCUMENT_ROOT'].'/modules/datenbank.php');
        $user_data = get_user_data(['email' => $_POST['email']]);

        if (empty($user_data)) {
            $error['email'] = 'Email nicht vorhanden.';
            echo json_encode($error);
            exit;
        }

        $user_data       = is_array($user_data)  ? (current($user_data)) : ($user_data);
        $password_verify = password_verify($_POST['passwort'], $user_data['hashed_passwort']);

        if (!$password_verify) {
            $error['passwort'] = 'Passwort falsch.';
            echo json_encode($error);
            exit;
        }

        $_SESSION['id']       = $user_data['id'];
        $_SESSION['email']    = $user_data['email']; 
        $_SESSION['loggedin'] = true; 
        session_handler();

        echo json_encode(true);
        exit;


    case 'registrieren':
    $error = [];

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Bitte eine gültige Email-Adresse eingeben.';
        echo json_encode($error);
        exit;
    }

    include_once($_SERVER['DOCUMENT_ROOT'].'/modules/datenbank.php');
    $user_data = get_user_data(['email' => $_POST['email']]);

    if(is_array($user_data)){
        $user_data = current($user_data);
    }

  
    if (!empty($user_data)) {
        $error['email'] = 'Account bereits vorhanden. Bitte loggen Sie sich mit dem richtigen Passwort ein.';
    }

    $check_password_stength = check_password_stength($_POST['passwort']);

    if($check_password_stength == false) {
        $error['passwort'] = 'Das Passwort sollte mindestens 8 Zeichen lang sein und mindestens einen Großbuchstaben, eine Zahl und ein Sonderzeichen enthalten.';
    }

    if (!empty($error)) {
        echo json_encode($error);
        exit;
    }

    $result = create_user_data(['email' => $_POST['email'], 'hashed_passwort' => $_POST['passwort']]);

    if(!empty($result)) {
        $_SESSION['id']       = $result;  
        $_SESSION['email']    = $_POST['email'];  
        $_SESSION['loggedin'] = true;
        session_handler();
        echo json_encode(true);
        exit;
    }

    echo json_encode(false);
    exit;
}



function create_user_data($attr=[]){
    include_once($_SERVER['DOCUMENT_ROOT'].'/modules/datenbank.php');

    $passwort_hashed = (isset($attr['hashed_passwort'])) ? (password_hash($attr['hashed_passwort'], PASSWORD_BCRYPT)) : ('');

    if (empty($passwort_hashed)) return false;

    $sql = '
    INSERT INTO
        `login_projekt`.`user_data`
    SET 
        `user_data`.`email`            = \''.trim(strtolower(mysqli_real_escape_string($GLOBALS[DBLINK], $attr['email']))).'\',
        `user_data`.`hashed_passwort`  = \''.$passwort_hashed.'\' 
    ';

    $res    = mysqli_query($GLOBALS[DBLINK], $sql);
    $res_id = mysqli_insert_id($GLOBALS[DBLINK]);

    if (!$res) return false;

    return $res_id;
}



function get_user_data($attr=[]) {
    include_once($_SERVER['DOCUMENT_ROOT'].'/modules/datenbank.php');

    $where  = '';
    $where .= isset($attr['id'])          ? (' AND `user_data`.`id`    = \''.mysqli_real_escape_string($GLOBALS[DBLINK], $attr['id']).'\' ')                 : ('');       
    $where .= isset($attr['not_this_id']) ? (' AND `user_data`.`id`    != \''.mysqli_real_escape_string($GLOBALS[DBLINK], $attr['not_this_id']).'\' ')       : ('');       
    $where .= isset($attr['email'])       ? (' AND `user_data`.`email` =  \''.strtolower(mysqli_real_escape_string($GLOBALS[DBLINK], $attr['email'])).'\' ') : ('');                                                            

	$sql = '
    SELECT
        `user_data`.`id`,
		`user_data`.`email`,
		`user_data`.`hashed_passwort`
    FROM 
        `login_projekt`.`user_data`
	WHERE
	    1=1
    '.$where.'';

    $res = mysqli_query($GLOBALS[DBLINK], $sql);

    $data = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }

    return $data;
}



function check_password_stength($passwort) {
    $uppercase     = preg_match('#[A-Z]#', $_POST['passwort']);
    $lowercase     = preg_match('#[a-z]#', $_POST['passwort']);
    $number        = preg_match('#[0-9]#', $_POST['passwort']);
    $special_chars = preg_match('#[^\w]#', $_POST['passwort']);

    if (!$uppercase || !$lowercase || !$number || !$special_chars || strlen($_POST['passwort']) < 8) {
        $result = false;
    } else {
        $result = true;
    }

    return $result;
}
?>
