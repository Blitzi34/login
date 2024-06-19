<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/modules/navigation.php');

function navigation() {

    $html_output ='
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="?template=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?template=profil">Profil</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?template=login">Login <span class="sr-only">(current)</span></a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link" id="logout_button" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <script src="/js/navigation.js?version='.time().'" type="text/javascript"></script>';

    return $html_output;
}

?>