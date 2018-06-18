<?php
require_once('DataBase.php');
require_once('DbManager.php');
require_once('RegionLanguageManager.php');
if (isset($_GET['region'])){
	$code_region = $_GET['region'];
	// $region = urldecode($region);
	$calledRegion = new RegionLanguageManager();
	$reponse = $calledRegion->read((int)$code_region);
	echo json_encode($reponse);
} else {
	echo 'Erreur dans la région';
	die;
}
