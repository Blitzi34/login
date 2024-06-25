<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
session_handler();

    function php_info() {
        
        if (empty($_SESSION['is_admin'])) {

            return '
            <div id="info_content" class="alert alert-danger">
                <span>
                    Nur für Admins sichtbar.
                </span>
            </div>';
        } 
    
        $html_output = '
        <div>
            '.phpinfo().'
        </div>';
    
        return $html_output;
    }
?>