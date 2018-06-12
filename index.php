<?php

if (isset($_GET['action'])) {
    switch ($_GET['action']){
        
        case "home":
            require "controllers/home.php";
            break;
    }
}


else {
    require "controllers/home.php";
}