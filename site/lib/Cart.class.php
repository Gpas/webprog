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
				if(($Quantity <= 0) || ($this->products[$prod]['quantity'] <= 0)){
					unset($this->products[$prod]);
				}
			}
		}
	}
	
	public function render(){
		$out = '<table class="pure-table pure-table-striped" >
				<thead>
					<tr>
						<th>Anzahl</th>
						<th>Name</th>
						<th>Preis</th>
						<th>Hinzufügen/Entfernen</th>
					</tr>
				</thead>
				<tbody>';
		if((isset($this->products)) && (count($this->products) > 0)) {
			foreach ($this->products as $product) {
				$prodData = Product::getProductbyId($product['id']);
				$out = $out . '<tr>
				<td>'.$product["quantity"]. ' </td>
				<td>'.$prodData->getName(). '  </td>
				<td>'.$prodData->getPrice().' CHF </td>
				<td><form method="post" class="pure-form" >
				 <input type="hidden" name="id" value="'.$product['id'].'">
				 <input type="hidden" name="quantity" value="1">
				 <input type="hidden" name="options" value="'.$product['options'].'">
				 <button type="button" class="addProduct pure-button">+</button>
				 <button type="button" class="removeProduct pure-button">-</button>
				</form></td>
				</tr>';
			}
			$out = $out . '</tbody>
			</table>';
		}
		else{
			$out = "Keine Produkte im Warenkorb.";
		}
		return $out;
	}
	
	public function renderSidebar(){
		$out = '<table class="pure-table pure-table-striped" >
				<thead>
				<tr>
					<th>Anzahl</th>
					<th>Name</th>
					<th>Preis</th>
				</tr>
				</thead>
				<tbody>';
		if((isset($this->products)) && (count($this->products) > 0)) {
			foreach ($this->products as $product) {
				$prodData = Product::getProductbyId($product['id']);
				$out = $out . '<tr>
				<td>'.$product["quantity"]. ' </td>
				<td>'.$prodData->getName(). '  </td>
				<td>'.$prodData->getPrice().' CHF </td>
				</tr>';
			}
			$out = $out . '</tbody>
			</table>';
		}
		else{
			$out = "Keine Produkte im Warenkorb.";
		}
		return $out;
	}
	
	public function getProducts(){
		return $this->products;
	}
	
}

?>