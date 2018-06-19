<?php
class Region extends GeoElt{
	//code_region, region, total, php, javascript, python, java, ruby, c, cPlusPlus, cSharp
	
	protected $region;
	

	public function __construct(int $code_region, string $region){
		$this->code_region = $code_region;
		$this->region = $region;
	}
	// setters
	public function set_region(string $region){
		$this->region = $region;
	}
	
	public function get_region(){
		return $this->region;
	}
}
//code_region, region, total, php, javascript, python, java, ruby, c, cPlusPlus, cSharp

// instancier avec eval en bouclant les keys et les values du tableau 
// associatif code_region => nom_region
// $regionEnCours = eval('$region_'key' = new Region((int)'key', 'value');');
// 
// on peut récupérer les propriétés dans un tableau 
// avec get_object_vars(this);