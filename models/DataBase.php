<?php
class DataBase{

	private $host;
	private $dbname;
	private $user;
	private $pass;
	private $instance;

<<<<<<< HEAD
	public function __construct($host = "localhost", $dbname = "tech_tracker", $user = "adnane", $pass = "piccolo333"){
=======
	public function __construct($host = "localhost", $dbname = "tech_tracker", $user = "admin", $pass = "online@2017"){
>>>>>>> 40cab792399e62ed0cdc3674af5cb3bcf4950f99
		$this->host = $host;
		$this->dbname = $dbname;
		$this->user = $user;
		$this->pass = $pass;
		$this->instance = $this->connect();
	}
	private function connect(){
		try{
			$dbh = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname .";charset=utf8", $this->user, $this->pass);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
			return $dbh;
		} catch(PDOException $e){
			echo 'Echec lors de la connexion : ' . $e->getMessage();
		}		
	}
	public function getInstance(){
		return $this->instance;
	}
}