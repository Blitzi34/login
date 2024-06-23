<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
session_handler();

include_once($_SERVER['DOCUMENT_ROOT'].'/modules/home.php');

function home() {

    $html_output = '
    <div id="home" class="d-flex align-items-center position-relative" style="background-image:url(./assets/backround_image.jpg); height: 100vh;">

    </div>

    <script src="/js/home.js?version='.time().'" type="text/javascript"></script>';

    return $html_output;
}

?>