<?php
    require 'vendor/autoload.php';
    
    $loader = new Twig_Loader_Filesystem('views'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));
    $template = $twig->load('layout.html');
    echo $template->render(array(''));