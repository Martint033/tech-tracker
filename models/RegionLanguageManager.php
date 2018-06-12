<?php
class RegionLanguageManager extends DbManager{

	public function __construct(){
		parent::__construct();
		$this->table = "region_language";
	}
	public function read(int $codeRegion){
		$sql = "SELECT * FROM " . $this->table . " WHERE code_region = " . $codeRegion;
		$req = $this->dbh->prepare($sql);
		$req->execute();
		return $req->fetch(PDO::FETCH_ASSOC);
	}
	// attend un tableau assoc [code_region, region, total, php, javascript, python, java, ruby, c, c++, c#]
	public function insert(array $data){
		$sql = "INSERT INTO " . $this->table . " (code_region, region, total, php, javascript, python, java, ruby, c, c++, c#) VALUES (:code_region, :region, :total, :php, :javascript, :python, :java, :ruby, :c, :c++, :c#)";
		$req = $this->dbh->prepare($sql);
		$req->bindParam(':code_region', $data['code_region'], PDO::PARAM_INT);
		$req->bindParam(':region', $data['region'], PDO::PARAM_STR);
		$req->bindParam(':total', $data['total'], PDO::PARAM_INT);
		$req->bindParam(':php', $data['php'], PDO::PARAM_INT);
		$req->bindParam(':javascript', $data['javascript'], PDO::PARAM_INT);
		$req->bindParam(':python', $data['python'], PDO::PARAM_INT);
		$req->bindParam(':java', $data['java'], PDO::PARAM_INT);
		$req->bindParam(':ruby', $data['ruby'], PDO::PARAM_INT);		
		$req->bindParam(':c', $data['c'], PDO::PARAM_INT);
		$req->bindParam(':c++', $data['c++'], PDO::PARAM_INT);
		$req->bindParam(':c#', $data['c#'], PDO::PARAM_INT);
		$req->execute();	
	}
	// attend un code région et un tableau associatif
	// ['total' => n, 'php' => n]
	public function update(int $codeRegion, array $data){
		
		$sql = "UPDATE " . $this->table . " SET ";
		$keys = array_keys($data); 
		foreach ($keys as $key) {
			$sql .= $key . "= :" .$key;
		}
		$sql .= " code_region = " . $codeRegion;
		$req = $this->dbh->prepare($sql);
		for ($i = 0; $i < count($data); $i++){
			if (is_int($data[i])){
				$req->bindParam(':' . $keys[i], $data[i], PDO::PARAM_INT);
			}
			if (is_string($data[i])){
				$req->bindParam(':' . $keys[i], $data[i], PDO::PARAM_STR);
			}			
		}
		$req->execute();
	}
	public function delete(int $id){
		$sql = "DELETE FROM " . $this->table . " WHERE id = " . $id;
		$req = $this->dbh->prepare($sql);
		$req->execute();
	} 
}