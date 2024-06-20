<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
session_handler();

include_once($_SERVER['DOCUMENT_ROOT'].'/modules/login.php');

function login() {

    $html_output =
    '<form id="login_form">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="E-mail">
            <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="passwort">Password</label>
            <input type="password" class="form-control" id="passwort" name="passwort" placeholder="Passwort">
        </div>
        <button id="submit_login"         funktion="login"        class="btn btn-success"  >Anmelden</button>
        <button id="submit_registrieren"  funktion="registrieren" class="btn btn-secondary">Registrieren</button>
    </form>

    <script src="/js/login.js?version='.time().'" type="text/javascript"></script>';

    return $html_output;
}

?>