<?php

class Cart{
	
	private $products;
	
	public function __construct() {
		session_start();
		if(empty($_SESSION['cart'])) {
			$_SESSION['cart'] = $this;
		}
		$this->reset();
	}
	
	public function reset(){
		$this->products = array();
	}
	
	public function addProduct($Id, $Quantity="1", $Options="-1"){
		$duplicate = FALSE;
		$product = array('id' => $Id, 'quantity' => $Quantity, 'options' => $Options);
		if(count($this->products)> 0){
			foreach ($this->products as $prod => $content){
				if (($content['id'] == $product['id']) && ($content['options'] == $product['options'])) {
					$this->products[$prod]['quantity'] += $product['quantity'];
					$duplicate = TRUE;
				}
			}
		}
		if (!$duplicate) {
			$this->products[] = $product;
		}
	}
	
	public function removeProduct($Id, $Quantity="1", $Options="-1"){
		$product = array('id' => $Id, 'quantity' => $Quantity, 'options' => $Options);
		foreach ($this->products as $prod => $content){
			if (($content['id'] == $product['id']) && ($content['options'] == $product['options'])) {
				$this->products[$prod]['quantity'] -= $product['quantity'];
				if(($Quantity <= 0) || ($products[$prod]['quantity'] <= 0)){
					unset($this->products[$prod]);
				}
			}
		}
	}
	
	public function render(){
		$out = "";
		if(isset($this->products)) {
			foreach ($this->products as $product) {
				$out = $out . 'Produkt '.$product["id"].' ist '.$product["quantity"].' mal im Warenkorb <br>
				<form method="post" action="/index.php?action=warenkorb">
				 <input type="submit" name="additem" value="+" />
				</form>
				
				<form method="post" action="/index.php?action=warenkorb">
				 <input type="submit" name="removeitem" value="-" />
				</form>
				 ';
			}
		}
		else{
			$out = "Keine Produkte im Warenkorb.";
		}
		return $out;
	}
	
	public function renderSidebar(){
		$out = "";
		if(isset($this->products)) {
			foreach ($this->products as $product) {
				
				$out = $out .  'Produkt '.$product["id"].' ist '.$product["quantity"].' mal im Warenkorb <br>
				<form method="post" action="/index.php?action=warenkorb">
				 <input type="submit" name="additem" value="+" />
				</form>
				
				<form method="post" action="/index.php?action=warenkorb">
				 <input type="submit" name="removeitem" value="-" />
				</form>
				 ';
				 
				 }
		}
		else{
			$out = "Keine Produkte im Warenkorb.";
		}
		return $out;
	}
	
}

?>