<?php
abstract class DbManager{
	protected $dbh;
	protected $table;

	public function __construct(){
		$db = new DataBase();
		$this->dbh = $db->getInstance();
		
	}
	// list fonctionne sans paramêtre mais s'il en a un
	// celui ci rajoute une valeur limite à la requête SQL
	public function list(int $limit = 0){
		$sql = "SELECT * FROM " . $this->table;
		if ($limit > 0){
			$sql .= " LIMIT " . $limit;
		}
		$req = $this->dbh->prepare($sql);
		$req->execute();
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
}