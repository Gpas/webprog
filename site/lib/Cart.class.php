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
	
	public function addProduct($Id, $Quantity="1", $Options="-1"){
		$duplicate = FALSE;
		$product = array('id' => $Id, 'quantity' => $Quantity, 'options' => $Options);
		foreach ($products as $prod => $content){
			if (($content['id'] == $product['id']) && ($content['options'] == $product['options'])) {
				$products[$prod]['quantity'] += $product['quantity'];
				$duplicate = TRUE;
			}
		}
		if (!$duplicate) {
			array_push($products, $product);
		}
	}
	
	public function removeProduct($Id, $Quantity="1", $Options="-1"){
		$product = array('id' => $Id, 'quantity' => $Quantity, 'options' => $Options);
		foreach ($products as $prod => $content){
			if (($content['id'] == $product['id']) && ($content['options'] == $product['options'])) {
				$products[$prod]['quantity'] -= $product['quantity'];
				if(($Quantity <= 0) || ($products[$prod]['quantity'] <= 0)){
					unset($products[$prod]);
				}
			}
		}
	}
	
	public function render(){
		foreach ($products as $product) {
			echo 'Produkt '.$product["id"].' ist '.$product["quantity"].' mal im Warenkorb <br>
			<form method="post" action="/index.php?action=warenkorb">
			 <input type="submit" name="additem" value="+" />
			</form>
			
			<form method="post" action="/index.php?action=warenkorb">
			 <input type="submit" name="removeitem" value="-" />
			</form>
			 ';
		}
	}
	
	public function reset(){
		$products = array();
	}
	
	
	
}

?>