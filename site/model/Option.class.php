<?php 
class Option {
	private $id;
	private $values;
	private $name;
	private $selected;
	private $prices;
	
	//getters
	public function getId(){
		return $this->id;
	}
	public function getValues(){
		return $this->values;
	}
	public function getPrices(){
		return $this->prices;
	}
	
	
	public function getName(){
		return $this->name;
	}
	
	public function getSelected(){
		return $this->selected;
	}
	
	//setters
	public function setValues($values){
		$this->values = $values;
	}
	
	public function setSelected($id){
		$this->selected = $id;
	}
	
	//functions
	public static function getOptionsByProduct($productId) {
		$langCode = $_COOKIE['lang'];
		$options = array();
		$res = DB::doQuery("SELECT o.id AS id, o.opt_values AS 'values' , o.name AS name, o.prices AS prices FROM options o 
		WHERE o.lang_code = '$langCode' AND o.id IN (SELECT p.option_id FROM prod_opt p WHERE p.prod_id = '$productId')");	
		if ($res) {
			while ($option = $res->fetch_object(get_class())) {
				$options[] = $option;
			}
		}
		
		return $options;

	}
	
	public function getPrice(){
		$values = explode("|",$this->getPrices());
		if(isset($this->selected)){
			return $values[$this->selected];
		}
		else{
			return 0 ;
		}
	}
	
	public function render(){
		$values = explode("|",$this->getValues());
		$out = '<fieldset class="options"><legend>'.$this->getName().'</legend>';
		for($i = 0; $i < count($values); $i++ )
		{
			$out = $out . '<label class="pure-radio"><input type="radio" name="options['.$this->getId().']" value="'.$i.'">'.$values[$i].'</label>'; 
		}
		$out = $out . '</fieldset>';
		return $out;
	}

}
?>
