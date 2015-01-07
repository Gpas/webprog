<?php 
class Options {
	private $id;
	private $values;
	
	//getters
	public function getId(){
		return $this->id;
	}
	public function getValues(){
		return $this->values;
	}
	
	//setters
	public function setValues($values){
		$this->values = $values;
	}
	
	//functions
	public static function getOptions($name, $pw) {
		$res = DB::doQuery("SELECT o.*, FROM options o LEFT OUTER JOIN products p ON o.id = p.id ");
		
		$options = $res->fetch_object(get_class());
		
		return $options;

	}

}
?>
