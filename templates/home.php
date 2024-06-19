<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/home.php');

function home() {

    $html_output =
    '<div>
        HOME
    </div>

    <script src="/js/home.js?version='.time().'" type="text/javascript"></script>';

    return $html_output;
}

?>