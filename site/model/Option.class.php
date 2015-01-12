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
	public function setPrices($prices){
		$this->prices = $prices;
	}
	
	public function setSelected($id){
		$this->selected = $id;
	}
	
	//functions
	public static function getOptionsByProduct($productId) {
		$langCode = $_COOKIE['lang'];
		$options = array();
		$res = DB::doQuery("SELECT o.options_id AS id, o.opt_values AS 'values' , o.name AS name, o.prices AS prices FROM options o 
		WHERE o.lang_code = '$langCode' AND o.options_id IN (SELECT p.option_id FROM prod_opt p WHERE p.prod_id = '$productId')");	
		if ($res) {
			while ($option = $res->fetch_object(get_class())) {
				$option->setValues(explode("|",$option->getValues()));
				$option->setPrices(explode("|",$option->getPrices()));
				$options[] = $option;
			}
		}
		
		return $options;

	}
	
	public function getValue(){
		if(isset($this->selected)){
			return $values[$this->selected];
		}
		else{
			return 0 ;
		}
	}
	
	public function getPrice(){
		if(isset($this->selected)){
			return $prices[$this->selected];
		}
		else{
			return 0 ;
		}
	}
	
	public function render(){
		$out = '<fieldset class="options"><legend>'.$this->getName().'</legend>';
		for($i = 0; $i < count($this->values); $i++ )
		{
			$out = $out . '<label class="pure-radio"><input type="radio" name="options['.$this->getId().']" value="'.$i.'">'.$this->values[$i].'</label>'; 
		}
		$out = $out . '</fieldset>';
		return $out;
	}

}
?>
