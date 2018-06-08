<?php




if (isset($_GET['action'])) {
    switch ($_GET['action']){
        
        case "home":
            require "models/home.php";
            break;
    }
}

else {
    require "models/home.php";
}