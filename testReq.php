<?php

require "models/Database.php";
require "models/DbManager.php";
require "models/CommuneManager.php";
require "models/RegionLanguageManager.php";



function totalRepo($localite, $language){
    $url = 'https://api.github.com/search/users?client_id=05350e6d2ae541f5631b&client_secret=5cce9bb3410b09f7398e47868663bac7425726ee&q=location:' . urlencode($localite) . '+language:' . $language;

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


$town = allTownIn(11);
$totalLang = 0;
$etat = 0;
// for ($y=0; $y<$language.length; $y++){

    for ($x=0; $x < count($town); $x++){
        echo $town[$x]['nom_commune'].'</br>';
        $totalLang += totalRepo($town[$x]['nom_commune'], 'php');
       
        $etat++;
        if ($etat > 29){
            sleep(60);
            $etat = 0;
        }
    }

echo $totalLang;


// curl -i 'https://api.github.com/users/whatever?client_id=05350e6d2ae541f5631b&client_secret=5cce9bb3410b09f7398e47868663bac7425726ee'