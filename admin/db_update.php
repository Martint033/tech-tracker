<?php

require "../models/DataBase.php";
require "../models/DbManager.php";
require "../models/CommuneManager.php";
require "../models/RegionLanguageManager.php";
require "../models/CommuneLanguageManager.php";
require "../models/GeoElt.php";
require "../models/Region.php";
require "../models/Commune.php";
require "../models/LastUpdateDateManager.php";
define('BR', '<br>');
ini_set('max_execution_time', 300);
$update = new RegionLanguageManager();

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




function totalRepo($localite, $language){
    $url = 'https://api.github.com/search/users?client_id=05350e6d2ae541f5631b&client_secret=5cce9bb3410b09f7398e47868663bac7425726ee&q=location:' . urlencode($localite) . '+language:' . urlencode($language);

    $req = curl_init();
    curl_setopt($req, CURLOPT_URL, $url);
    curl_setopt($req, CURLOPT_USERAGENT, 'tech-tracker');
    curl_setopt($req, CURLOPT_RETURNTRANSFER, $url);

    $rep = curl_exec($req);
    $rep = json_decode($rep);
    $total = $rep->total_count;

    curl_close($req);

    return $total;
}



function allTownIn($region){  
    $communeManager = new CommuneManager();
    return $communeManager->townByRegion($region);
}



$total = 0;
$etat = 0;

echo 'Début de la mise à jour de la base de donnée langage par région' . BR;

foreach ($code_region as $keyReg => $valueReg){
    
    $regionEnCours = new Region((int)$keyReg, $valueReg);
    $town = allTownIn($keyReg);
    $communes = array();// tableau des instances de Commune
    for ($i = 0; $i < count($town); $i++){
        $commune = new Commune($town[$i]['id'], $town[$i]['code_region'], $town[$i]['nom_commune']);
        $communes[] = $commune;
    }
    echo "Region en cours = " . $regionEnCours->get_region() . BR;
    
    for ($y = 0; $y < count($allLanguage); $y++) {

        echo "Traitement langage = " . $allLanguage[$y] . BR;

        for ($x=0; $x < count($town); $x++){
            $communeEnCours = $communes[$x];
            echo "Ville en cours de traitement = " . $town[$x]['nom_commune'] . BR; 
            $reqTotal = totalRepo($town[$x]['nom_commune'], $allLanguage[$y] );
            $total += $reqTotal;
            echo 'Total pour la ville = ' . $reqTotal . BR;
            $setLangCommune = 'set_'.$allLanguage[$y];
            $communeEnCours->$setLangCommune($reqTotal);
            echo '<pre>';
            var_dump($communeEnCours);
            echo '</pre>';
            $etat++;
            if ($etat > 29){

                echo "Pause limit rate" . BR;

                sleep(60);
                $etat = 0;
            }
        }
       
        $setLang = 'set_'.$allLanguage[$y];
        $regionEnCours->$setLang($total);
        echo 'total repo = ' . $total . BR;
        
        $total = 0;
    }
    $regionEnCours->computeTotalRep();

    $verif = $update->read($keyReg);
    if (empty($verif)){
        $update->insert($regionEnCours->toArray());
        echo "Insertion BDD" . BR;
    }
    
    else {
        $update->update($keyReg, $regionEnCours->toArray());
        echo "Mise à jour BDD" . BR;
    }
    $communeBdd = new CommuneLanguageManager();
    for ($i = 0; $i < count($town); $i++){
        $communeEnCours = $communes[$i];
        $communeEnCours->computeTotalRep();
        $verif = $communeBdd->read($communeEnCours->get_id());
        if (empty($verif)){
            $communeBdd->insert($communeEnCours->toArray());
            echo "Insertion BDD" . BR;
        }
        
        else {
            $communeBdd->update($communeEnCours->get_id(), $communeEnCours->toArray());
            echo "Mise à jour BDD" . BR;
        }
    }   
}
$date = new LastUpdateDateManager();
$date->update();