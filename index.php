<?php
if (!isset( $_SESSION )) {
	session_start();
}


$template['name'] 	       	= (!empty($_GET['template'])) ? ($_GET['template']) : ('');
$template['template_file']  = "{$_SERVER['DOCUMENT_ROOT']}/templates/{$template['name']}.php";
$template['location']       = "/templates/{$template['name']}.php";


if (!file_exists($template['template_file'])) {
    echo "{$template['name']} -> Das Template konnte nicht gefunden werden";
    exit;
} 

include($template['template_file']);
$template['content'] 	= call_user_func($template['name']);

$html_output =
'<!DOCTYPE html>
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

    <div id="template-content" class="m-0 pb-0 p-1">			
        '.$template['content'].'
    </div>
</body>';

echo $html_output;

?>