<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/sample.php');

session_handler();

function sample() {

    $html_output =
    '<div>
        Test Template
    </div>

    <script src="/js/sample.js?version='.time().'" type="text/javascript"></script>';

    return $html_output;
}

?>