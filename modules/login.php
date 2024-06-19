<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$funktion = (isset($_POST['funktion']))  ? ($_POST['funktion']) : ( isset($_GET['funktion']) ? ($_GET['funktion']) : '');

switch ($funktion) {

    case 'login':

        $user_data = get_user_data(['email' => $_POST['email']]);
        $user_data = is_array($user_data)  ? (current($user_data)) : ($user_data);

        $password_verify = password_verify($_POST['passwort'], $user_data['hashed_passwort']);

        if (!$password_verify) {
            echo json_decode(false);
            exit;
        }

        $_SESSION['id'] = $user_data['id'];

        echo json_decode(true);
        exit;

    case 'registrieren':

    $user_data = get_user_data(['email' => $_POST['email']]);

    if(is_array($user_data)){
        $user_data = current($user_data);
    }

    $error = [];

    if (!empty($user_data)) {
        $error['email_doppelt'] = 'Account bereits vorhanden. Bitte loggen Sie sich mit dem richtigen Passwort ein.';
    }

    // if (strlen($_POST['passwort']) < 8) {
    //     $errors['passwort'][] = "Passwort muss mindestens 8 Zeichen enthalten";
    // }

    // if (!preg_match("#[0-9]+#", $_POST['passwort'])) {
    //     $errors['passwort'][] = "Passwort muss mindestens eine Zahl enthalten";
    // }

    // if (!preg_match("#[a-zA-Z]+#", $_POST['passwort'])) {
    //     $errors['passwort'][] = "Passwort muss mindestens einen Buchstaben enthalten";
    // }     

    if (!empty($error)) {
        echo json_encode($error);
        exit;
    }

    $result = create_user_data(['email' => $_POST['email'], 'hashed_passwort' => password_hash($_POST['passwort'], PASSWORD_BCRYPT), 'deleted' => 'false']);

    if(!empty($result)) {
        $_SESSION['id'] = $result;  
        echo json_encode(true);
        exit;
    }

    echo json_encode(false);
    exit;
}



function create_user_data($attr=[]){
    include_once($_SERVER['DOCUMENT_ROOT'] .'/modules/datenbank.php');

    $passwort_hashed = (isset($attr['hashed_passwort']))  ? (password_hash($attr['hashed_passwort'], PASSWORD_BCRYPT)) : ('');

    if (empty($passwort_hashed)) return false;

    $sql = '
    INSERT INTO
        `login_projekt`.`user_data`
    SET 
        `user_data`.`email`            = \''.mysqli_real_escape_string($GLOBALS[DBLINK],  $attr['email']).'\',
        `user_data`.`hashed_passwort`  = \''.$passwort_hashed.'\',
        `user_data`.`deleted` 	       = \''.mysqli_real_escape_string($GLOBALS[DBLINK],  $attr['deleted']).'\' 
    ';

    $res    = mysqli_query($GLOBALS[DBLINK], $sql);
    $res_id = mysqli_insert_id($GLOBALS[DBLINK]);

    if (!$res) return false;

    return $res_id;
}


function get_user_data($attr=[]) {
    include_once($_SERVER['DOCUMENT_ROOT'] .'/modules/datenbank.php');

    $where = '';

    $where .= isset($attr['id'])          ? (' AND `user_data`.`id`    = \''.mysqli_real_escape_string($GLOBALS[DBLINK], $attr['id']).'\' ')           : ('');       
    $where .= isset($attr['not_this_id']) ? (' AND `user_data`.`id`    != \''.mysqli_real_escape_string($GLOBALS[DBLINK], $attr['not_this_id']).'\' ') : ('');       
    $where .= isset($attr['email'])       ? (' AND `user_data`.`email` =  \''.mysqli_real_escape_string($GLOBALS[DBLINK], $attr['email']).'\' ')       : ('');                                                            

	$sql = '
    SELECT
        `user_data`.`id`,
		`user_data`.`email`,
		`user_data`.`hashed_passwort`,
		`user_data`.`deleted`
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



?>