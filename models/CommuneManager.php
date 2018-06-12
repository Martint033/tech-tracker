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
		$sql = 'SELECT REG_NOM AS region, COM_NOM_MAJ_COURT AS commune_maj_court, COM_NOM_MAJ AS commune_maj, COM_NOM AS commune_nom FROM ' . $this->table  . ' WHERE REG_NOM=' . $region;
		
		$req = $this->dbh->prepare($sql);
		$req->execute();
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	public function toJson(array $array){
		$value = json_encode($array);
		return $value;
	}
}