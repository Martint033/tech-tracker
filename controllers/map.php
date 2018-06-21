<?php
    require 'vendor/autoload.php';
    require "models/DataBase.php";
    require "models/DbManager.php";
	require "models/LastUpdateDateManager.php";
    $loader = new Twig_Loader_Filesystem('views'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));
    $dateManager = new LastUpdateDateManager();
    $date_last_update = $dateManager->read();
    $template = $twig->load('map.html');
    echo $template->render(array('date_update'=> $date_last_update));