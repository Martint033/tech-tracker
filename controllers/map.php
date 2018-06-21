<?php
require 'vendor/autoload.php';
require "models/DataBase.php";
require "models/DbManager.php";
require "models/CommuneManager.php";
require "models/RegionLanguageManager.php";
require "models/CommuneLanguageManager.php";
require "models/GeoElt.php";
require "models/Region.php";
require "models/Commune.php";
require "models/LastUpdateDateManager.php"; 

$loader = new Twig_Loader_Filesystem('views'); // Dossier contenant les templates
$twig = new Twig_Environment($loader, array(
  'cache' => false
));
$code_region = array('11' => 'Île-de-France',
					'24' => 'Centre-Val de Loire',
					'27' => 'Bourgogne-Franche-Comté',
					'28' => 'Normandie',
					'32' => 'Hauts-de-France',
					'44' => 'Grand Est',
					'52' => 'Pays de la Loire',
					'53' => 'Bretagne',
					'75' => 'Nouvelle-Aquitaine',
					'76' => 'Occitanie',
					'84' => 'Auvergne-Rhône-Alpes',
					'93' => 'Provence-Alpes-Côte d\'Azur',
                    '94' => 'Corse'); 
                                  

$allLanguage = ['php', 'javascript', 'python', 'java', 'ruby', 'c', 'cpp', 'csharp', 'assembly'];
$dateManager = new LastUpdateDateManager();
$date_last_update = $dateManager->read();
$townManager = new CommuneLanguageManager();
$topVillesParRegion = array();
$topTotalFrance = $townManager->topFive();
foreach ($code_region as $keyReg => $valueReg){
	$topVillesParRegion[] = array("code_region" => $valueReg, "villes" => $townManager->topFive((int)$keyReg));
}
    $dateManager = new LastUpdateDateManager();
    $date_last_update = $dateManager->read();
    $template = $twig->load('map.html');
    echo $template->render(array('topVillesParRegion' => $topVillesParRegion, 'topTotalFrance' => $topTotalFrance, 'date_update'=> $date_last_update));