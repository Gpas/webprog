<?php

class item{
	private $id;
	private $product;
	private $quantity;
	private $options;
	
	function __construct($productId, $quantity, $options){
		$this->id = $_SESSION['cart']->getNextItemId();
		$this->product = Product::getProductbyId($productId);
		$this->quantity = $quantity;
		$options_temp = Option::getOptionsByProduct($this->product->getId());
		if(isset($options) && (is_array($options))){
			foreach($options_temp as $option){
				if(array_key_exists($option->getId(), $options)){
					$option->setSelected($options[$option->getId()]);
					$this->options[] = $option;
				}
			}
		}
		
	}
	
	public function reload(){
		$this->product = Product::getProductbyId($this->product->getId());
		$options = Option::getOptionsByProduct($this->product->getId());
		foreach($options as $option){
			foreach($this->options as $option_used){
				if($option->getId() == $option_used->getId()){
					$selected = $option_used->getSelected();
					$option->setSelected($selected);
					$options_temp[]= $option;
				}
			}
		}
	}
	
	public function addAmount($amount){
		$this->quantity = $this->quantity + $amount;
	}
	
	public function getOptions(){
		if((isset($this->options)) && (is_array($this->options))){
			foreach($this->options as $option){
				$options[$option->getId()] = $option->getSelected();
			}
		}
		
		return isset($options) ? $options : -1;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getQuantity(){
		return $this->quantity;
	}
	
	public function getProduct() {
		return $this->product;
	}
	
	public function getTotal(){
		return $this->getPrice() * $this->quantity;
	}
	
	public function getPrice(){
		$price = $this->product->getPrice();
		if((isset($this->options)) && (is_array($this->options))){
			foreach($this->options as $option){
				$price = $price + $option->getPrice();
			}
		}
		return $price;
	}
	
}

?>