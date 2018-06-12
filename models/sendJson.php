<?php
require_once('Database.php');
require_once('CommuneManager.php');
if (isset($_GET['region'])){
	$region = $_GET['region'];
	// $region = urldecode($region);
	$communes = new CommuneManager();
	$villesRegion = $communes->communesParRégion($region);
	echo $communes->toJson($villesRegion); 
} else {
	echo 'Erreur dans la région';
	die;
}
