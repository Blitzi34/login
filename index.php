<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/templates/navigation.php');
session_handler();

/// Das aufgerufene Template wird über die index.php mit dem $_GET['template] Parameter aufgerufen
$template['name'] 	       = (!empty($_GET['template'])) ? ($_GET['template']) : ('');
$template['template_file'] = $_SERVER['DOCUMENT_ROOT'].'/templates/'.$template['name'].'.php';

$error_redir = '';
$error       = [];
$info_class = '';

if (!file_exists($template['template_file'])) {
    $error_redir = 'home';
    $error[]     = 'Seite nicht gefunden.';
}

if (!isset($_SESSION['loggedin'])) {
    $error_redir = 'home';
    $error[]     = 'Bitte loggen Sie sich ein.';
}

if(!empty($error)) {
    include_once($_SERVER['DOCUMENT_ROOT'].'/templates/'.$error_redir.'.php');
    $template['content']  = call_user_func($error_redir);
} 

if (file_exists($template['template_file'])) {
    include_once($template['template_file']);
    $template['location'] = '/templates/'.$template['name'].'.php';
    $template['content']  = call_user_func($template['name']);
} 

// echo '<pre>'
// .print_r($_SESSION, true).
// '</pre>';

$html_output = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Login-Projekt</title>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    <div id="template-content" class="m-0 pb-0 p-1">';

        $html_output .= '
        <div id="info_box" class="'.$info_class = (empty($error)) ? ('d-none') : ('').'">
            <div id="info_content" class="alert alert-warning">';
            if (!empty($error)) {
                foreach($error as $info_content) {
                    $html_output .= '<span>'.$info_content.'</span></br>';
                }
            }
            $html_output .= '
            </div>
        </div>';

        $html_output .= '  
        </div>
        <div id="navigation" class="sticky-top">'.call_user_func('navigation').'</div>
        <div id="content">'.$template['content'].'</div>
    </div>
</body>

<script src="/js/index.js?version='.time().'" type="text/javascript"></script>';

echo $html_output;
?>