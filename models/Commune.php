<?php
class Commune extends GeoElt{

	protected $id;
	protected $nom_commune;
	

	public function __construct(int $id, int $code_region, string $nom_commune){
		$this->nom_commune = $nom_commune;
		$this->id = $id;
		$this->code_region = $code_region;
	}
	// setters
	public function set_nom_commune(string $nom_commune){
		$this->nom_commune = $nom_commune;
	}
	public function set_id(int $id){
		$this->id = $id;
	}
	// getters	
	public function get_nom_commune(){
		return $this->nom_commune;
	}
	public function get_id(){
		return $this->id;
	}
}