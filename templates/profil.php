<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/profil.php');
session_handler();

function profil() {

    if(empty($_SESSION['id'])) {
        return false;
    }
    $get_user_data = [];
    $get_user_data = get_user_data(['id' => $_SESSION['id']]);

    if (!empty($get_user_data)) {
        $get_user_data = (is_array($get_user_data)) ? (current($get_user_data)) : ($get_user_data);
    }

    $html_output ='
    <form id="profil_from">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">E-Mail</span>
            </div>
            <input type="text" class="form-control" id="profil_email" name="profil_email" placeholder="E-mail" value="'.$get_user_data['email'].'">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Passwort</span>
            </div>
            <input type="password" class="form-control" id="profil_passwort" name="profil_passwort" placeholder="Passwort" value="">
        </div>

        <button id="profil_speichern" name="profil_speichern" funktion="profil_speichern" class="btn btn-success">Speichern</button>
    </form>
    
    <script src="/js/profil.js?version='.time().'" type="text/javascript"></script>';

    return $html_output;
}
?>