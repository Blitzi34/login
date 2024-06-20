<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
session_handler();

include_once($_SERVER['DOCUMENT_ROOT'].'/modules/login.php');

$funktion = (isset($_POST['funktion'])) ? ($_POST['funktion']) : ( isset($_GET['funktion']) ? ($_GET['funktion']) : '');

switch ($funktion) {

    case 'profil_speichern':
        
        $user_data = get_user_data(['not_this_id' => $_SESSION['id'], 'email' =>  $_POST['profil_email']]);

        $error = [];
        if (!empty($user_data)) {
            $error['profil_email'] = 'Email bereits vorhanden.';
        }

        if (!empty($error)) {
            echo json_encode($error);
            exit;
        }

        $passwort_hashed = (!empty($_POST['profil_passwort'])) ? (password_hash($_POST['profil_passwort'], PASSWORD_BCRYPT)) : ('');
        $result          = update_user_data_by_id(['id' => $_SESSION['id'], 'email' => $_POST['profil_email'], 'hashed_passwort' => $passwort_hashed, 'deleted' => 'false']);

        echo json_encode(true);
        exit;
}



function update_user_data_by_id($attr=[]){
    include_once($_SERVER['DOCUMENT_ROOT'] .'/modules/datenbank.php');
	
    $set = []; 

    if(!empty($attr['email'])){
        $set[] = ' `user_data`.`email` = \''.strtolower(mysqli_real_escape_string($GLOBALS[DBLINK], $attr['email'])).'\' ';
    }

    if(!empty($attr['hashed_passwort'])){
        $set[] = ' `user_data`.`hashed_passwort` = \''.mysqli_real_escape_string($GLOBALS[DBLINK], $attr['hashed_passwort']).'\' ';
    }

    if(!empty($attr['deleted'])){
        $set[] = ' `user_data`.`deleted` = \''.mysqli_real_escape_string($GLOBALS[DBLINK], $attr['deleted']).'\' ';
    }

	$where = '';

    $where .= isset($attr['id']) ? ' AND `user_data`.`id` = \''.mysqli_real_escape_string($GLOBALS[DBLINK], $attr['id']).'\'' : ('');

	$sql = '
	UPDATE
        `login_projekt`.`user_data`
    SET
        '.implode(',' , $set).' 
	WHERE
		1=1'
		.$where;

	$res = mysqli_query($GLOBALS[DBLINK], $sql);

    return $res;	
}

?>