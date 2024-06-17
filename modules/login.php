<?php

if (!isset($_SESSION)) {
    session_start();
}



$funktion        = (isset($_POST['funktion']))  ? ($_POST['funktion'])                                 : ( isset($_GET['funktion']) ? ($_GET['funktion']) : '');

switch ($funktion) {

    case 'login':
        
        $user_data = get_user_data(['email' => $_POST['email']]);

        $result = !empty($user_data) ? ($user_data)       : (false);
        $result = is_array($result)  ? (current($result)) : ($result);

        $password_verify = password_verify($_POST['passwort'], $result['hashed_passwort']);

        echo json_encode($password_verify);
        exit;

    case 'registrieren':

    $result = insert_user_data(['email' => $_POST['email'], 'hashed_passwort' => $passwort_hashed, 'deleted' => 'false']);

    echo json_encode($result);
    exit;
}



function insert_user_data($attr=[]){
    include_once($_SERVER['DOCUMENT_ROOT'] .'/modules/datenbank.php');

    $passwort_hashed = (isset($attr['hashed_passwort']))  ? (password_hash($attr['hashed_passwort'], PASSWORD_BCRYPT)) : ('');

    if (empty($passwort_hashed)) {
        return false;
    }

    $sql = '
    INSERT INTO
        `login_projekt`.`user_data`
    SET 
        `user_data`.`email`            = \''.mysqli_real_escape_string($GLOBALS[DBLINK],  $attr['email']).'\',
        `user_data`.`hashed_passwort`  = \''.$passwort_hashed.'\',
        `user_data`.`deleted` 	       = \''.mysqli_real_escape_string($GLOBALS[DBLINK],  $attr['deleted']).'\' 
    ';

    // var_dump($sql);
    // exit;

    $res = mysqli_query($GLOBALS[DBLINK], $sql);

    return $res;
}


function get_user_data($attr=[]) {
    include_once($_SERVER['DOCUMENT_ROOT'] .'/modules/datenbank.php');

    $where = '';

    $where .= isset($attr['email'])           ? (' AND `user_data`.`email`           = \''.mysqli_real_escape_string($GLOBALS[DBLINK], $attr['email']).'\' ')  : ('');                                                            
    // $where .= isset($attr['hashed_passwort']) ? (' AND `user_data`.`hashed_passwort` = \''.$attr['hashed_passwort'].'\' ')                                   : ('');


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