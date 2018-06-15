
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


// $code_region = [11, 24, 27, 28, 32, 44, 52, 53, 75, 76, 84, 93, 94];

$town = allTownIn(11);
$totalLang = 0;
$etat = 0;
// for ($y=0; $y<$language.length; $y++){

    for ($x=0; $x < count($town); $x++){
        
        $totalLang += totalRepo($town[$x]['nom_commune'], 'php');
       
        $etat++;
        if ($etat > 29){
            sleep(60);
            $etat = 0;
        }
    }

echo $totalLang;


// curl -i 'https://api.github.com/users/whatever?client_id=05350e6d2ae541f5631b&client_secret=5cce9bb3410b09f7398e47868663bac7425726ee'

