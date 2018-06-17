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
	// attend un tableau assoc [code_region, region, total, php, javascript, python, java, ruby, c, cpp, csharp]
	public function insert(array $data){
		// var_dump($data);
		$sql = 'INSERT INTO ' . $this->table . ' (code_region, region, total, php, javascript, python, java, ruby, c, cpp, csharp, assembly) VALUES (:code_region, :region, :total, :php, :javascript, :python, :java, :ruby, :c, :cpp, :csharp, :assembly)';
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
		$req->bindParam(':cpp', $data['cpp'], PDO::PARAM_INT);
		$req->bindParam(':csharp', $data['csharp'], PDO::PARAM_INT);
		$req->bindParam(':assembly', $data['assembly'], PDO::PARAM_INT);
		$req->execute();	
	}
	// attend un code région et un tableau associatif
	// ['total' => n, 'php' => n]
	public function update(int $codeRegion, array $data){
		
		$sql = "UPDATE " . $this->table . " SET ";
		$keys = array_keys($data);
		$keyslength = count($keys);
		// probleme virgule à ajouter boucle à changer
		for ($i = 0; $i < $keyslength; $i++){
			if ($i < $keyslength - 1){
				$sql .= $keys[$i] . "= :" . $keys[$i] . ", ";
			} else {
				$sql .= $keys[$i] . "= :" . $keys[$i];
			}			
		}
		$sql .= " WHERE code_region = " . $codeRegion;
		$req = $this->dbh->prepare($sql);
		for ($i = 0; $i < count($data); $i++){
			if (is_int($data[$keys[$i]])){
				$req->bindParam(':' . $keys[$i], $data[$keys[$i]], PDO::PARAM_INT);
			}
			if (is_string($data[$keys[$i]])){
				$req->bindParam(':' . $keys[$i], $data[$keys[$i]], PDO::PARAM_STR);
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