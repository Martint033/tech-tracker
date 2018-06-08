<?php


if (isset($_GET['action'])) {
    switch ($_GET['action']){
        
        case "home":
            require "controllers/home.php";
            break;

        case "test":
            require "controllers/test.php";
            break;
    }
}


else {
    require "controllers/home.php";
}