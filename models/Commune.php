<?php
class Commune extends GeoElt{

	protected $id;
	protected $nom_commune;
	

	public function __construct(int $id, string $nom_commune){
		$this->nom_commune = $nom_commune;
		$this->id = $id;
	}
	// setters
	public function set_nom_commune(string $nom_commune){
		$this->nom_commune = $nom_commune;
	}
	// getters	
	public function get_nom_commune(){
		return $this->nom_commune;
	}
}