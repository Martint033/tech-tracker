<?php
if (!isset($_SESSION)){
    session_start();
}
if (isset($_GET['action'])) {
    switch ($_GET['action']){
        
        case "home":
            require "controllers/home.php";
            break;

        case "map":
            require "controllers/map.php";
            break;

        case "test":
            require "controllers/test.php";
            break;

        case "compare":
            require "controllers/compare.php";
            break;
        case "top":
            require "controllers/top.php";
            break;
    }
}
else {
    require "controllers/home.php";
}