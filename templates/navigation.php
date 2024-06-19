<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');

function navigation() {

    $html_output ='
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li id="home" class="nav-item">
                    <a class="nav-link" href="?template=home">Home</a>
                </li>';

                if (!isset($_SESSION['id'])){
                    $html_output .= ' 
                    <li id="login" class="nav-item">
                        <a class="nav-link" href="?template=login">Login</a></span>
                    </li>';
                }

                if (isset($_SESSION['id'])){
                    $html_output .= '
                    <li id="profil" class="nav-item">
                        <a class="nav-link" href="?template=profil">Profil</a>
                    </li>';
                }

            $html_output .= ' 
            </ul>

            <ul class="navbar-nav ml-auto">';

                if(isset($_SESSION['email'])){
                    $html_output .= ' 
                    <li id="logout" class="nav-item">
                        <a class="nav-link" id="logout_button" href="#">Logout</a></span>
                    </li>
                    
                    <li id="login_email" class="nav-item">
                        <a class="nav-link" id="login_email_button" href="#">'.$_SESSION['email'].'</a></span>
                    </li>';

                }

                $html_output .= '
            </ul>
        </div>
    </nav>

    <script src="/js/navigation.js?version='.time().'" type="text/javascript"></script>';

    return $html_output;
}

?>