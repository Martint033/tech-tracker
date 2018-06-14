<?php
/**
 * 
 */
class CommuneManager extends DbManager
{
	public function __construct(){
		parent::__construct();
		$this->table = "commune_region";
	}
	// read peut recevoir un int correspondant à l'id
	// ou une string correspondant au nom de la ville
	public function read($town){
		if (is_string($town)){
			$town = $this->dbh->quote($town); 
			$sql = "SELECT * FROM " . $this->table . " WHERE nom_commune = " . $town;
		}
		if (is_int($town)){
			$sql = "SELECT * FROM " . $this->table . " WHERE id = " . $town;
		}
		$req = $this->dbh->prepare($sql);
		$req->execute();
		return $req->fetch(PDO::FETCH_ASSOC);
	}
}