<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
session_handler();

    function php_info() {

        $html_output = '
        <div>
            '.phpinfo().'
        </div>';
    
        return $html_output;
    }
?>