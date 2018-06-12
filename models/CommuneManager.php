<?php
/**
 * 
 */
class CommuneManager
{
	private $dbh;
	private $table;

	function __construct(string $table = "commune_region")
	{
		$db = new DataBase();
		$this->dbh = $db->getInstance();
		$this->table = $table;
	}
	public function communesParRégion(string $region){
		// $region = str_replace("'", "\/'", $region);
		// var_dump($region);
		// die;
		$region = $this->dbh->quote($region);
		$sql = 'SELECT nom_region AS region, nom_commune AS nom_commune FROM ' . $this->table  . ' WHERE code_region=' . $region;
		
		$req = $this->dbh->prepare($sql);
		$req->execute();
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	public function toJson(array $array){
		$value = json_encode($array);
		return $value;
	}
}