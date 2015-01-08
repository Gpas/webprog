<?php 
class Option {
	private $id;
	private $values;
	private $name;
	
	//getters
	public function getId(){
		return $this->id;
	}
	public function getValues(){
		return $this->values;
	}
	
	public function getName(){
		return $this->name;
	}
	
	//setters
	public function setValues($values){
		$this->values = $values;
	}
	
	//functions
	public static function getOptionsByProduct($productId, $langCode="de") {
		$res = DB::doQuery("SELECT o.id AS id, o.opt_values AS 'values', l.name AS name FROM options o LEFT OUTER JOIN
		 options_lang l ON o.id = l.options_id WHERE l.lang_code = '$langCode' AND o.id IN (SELECT p.option_id FROM prod_opt p WHERE p.prod_id = '$productId')");	
		if ($res) {
			while ($option = $res->fetch_object(get_class())) {
				$options[] = $option;
			}
		}
		
		return $options;

	}
	
	public function render(){
		$values = explode(",",$this->getValues());
		
	}

}
?>
