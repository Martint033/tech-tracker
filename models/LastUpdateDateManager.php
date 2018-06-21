<?php
class LastUpdateDateManager extends DbManager{

	public function __construct(){
		parent::__construct();
		$this->table = "last_update_date";
	}
	public function read(){
		$sql = "SELECT * FROM " . $this->table . " WHERE id = 1";
		$req = $this->dbh->prepare($sql);
		$req->execute();
		return $req->fetch(PDO::FETCH_ASSOC);
	}
	public function update(){
		$sql = "UPDATE " . $this->table . " SET date_last_update = DATE(NOW())";
		$req = $this->dbh->prepare($sql);
		$req->execute();
	}
}