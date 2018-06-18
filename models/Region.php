<?php
class Region{
	//code_region, region, total, php, javascript, python, java, ruby, c, cPlusPlus, cSharp
	protected $code_region;
	protected $region;
	protected $total;
	protected $php;
	protected $javascript;
	protected $python;
	protected $java;
	protected $ruby;
	protected $c;
	protected $cpp;
	protected $csharp;
	protected $assembly;

	public function __construct(int $code_region, string $region){
		$this->code_region = $code_region;
		$this->region = $region;
	}
	// setters
	public function set_code_region(int $code){
		$this->code_region = $code;
	}
	public function set_region(string $region){
		$this->region = $region;
	}
	public function set_total(int $value){
		$this->total = $value;
	}
	public function set_php(int $value){
		$this->php = $value;
	}
	public function set_python(int $value){
		$this->python = $value;
	}
	public function set_java(int $value){
		$this->java = $value;
	}
	public function set_ruby(int $value){
		$this->ruby = $value;
	}
	public function set_javascript(int $value){
		$this->javascript = $value;
	}
	public function set_c(int $value){
		$this->c = $value;
	}
	public function set_cpp(int $value){
		$this->cpp = $value;
	}
	public function set_csharp(int $value){
		$this->csharp = $value;
	}
	public function set_assembly(int $value){
		$this->assembly = $value;
	}
	// getters
	public function get_code_region(){
		return $this->code_region;
	}
	public function get_region(){
		return $this->region;
	}
	public function get_total(){
		return $this->total;
	}
	public function get_php(){
		return $this->php;
	}
	public function get_python(){
		return $this->python;
	}
	public function get_java(){
		return $this->java;
	}
	public function get_ruby(){
		return $this->ruby;
	}
	public function get_javascript(){
		return $this->javascript;
	}
	public function get_c(){
		return $this->c;
	}
	public function get_cpp(){
		return $this->cpp;
	}
	public function get_csharp(){
		return $this->csharp;
	}
	public function get_assembly(){
		return $this->assembly;
	}
	public function toArray(){
		return get_object_vars($this);
	}
	public function computeTotalRep(){
		$total = $this->php + $this->javascript + $this->python + $this->java + $this->ruby + $this->c + $this->cpp + $this->csharp + $this->assembly;
		$this->total = $total;
	}
}
//code_region, region, total, php, javascript, python, java, ruby, c, cPlusPlus, cSharp

// instancier avec eval en bouclant les keys et les values du tableau 
// associatif code_region => nom_region
// $regionEnCours = eval('$region_'key' = new Region((int)'key', 'value');');
// 
// on peut récupérer les propriétés dans un tableau 
// avec get_object_vars(this);