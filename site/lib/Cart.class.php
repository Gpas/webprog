<?php

class Cart{
	
	private $products;
	private $item_count = 0;
	
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
	
	public function reload(){
		foreach($this->products as $product){
			$product->reload();
		}
	}
	
	public function addProduct($Id, $Quantity="1", $Options="-1"){
		$duplicate = FALSE;
		$product = array('id' => $Id, 'quantity' => $Quantity, 'options' => $Options);
		if(count($this->products) > 0){
			foreach ($this->products as $id => $item){
				if (($item->getProduct()->getId() == $product['id']) && ($item->getOptionsAsCompareArray() == $product['options'])) {
					$this->products[$id]->addAmount($product['quantity']);
					$duplicate = TRUE;
				}
			}
		}
		if (!$duplicate) {
			$this->products[] = new item($product['id'], $product['quantity'], $product['options']);
		}
	}
	
	public function addItem($item_id){
		if(count($this->products) > 0){
			foreach ($this->products as $id => $item){
				if ($item->getId() == $item_id) {
					$this->products[$id]->addAmount(1);
				}
			}
		}
	}
	
	public function removeItem($item_id){
		if(count($this->products) > 0){
			foreach ($this->products as $id => $item){
				if ($item->getId() == $item_id) {
					$this->products[$id]->addAmount(-1);
					if($this->products[$id]->getQuantity() <= 0){
						unset($this->products[$id]);
					}
				}
			}
		}
	}
	
	public function render(){
		$out = '<table class="pure-table pure-table-striped" >
				<thead>
					<tr>
						<th>Hinzufügen/Entfernen</th>
						<th>Name</th>
						<th>Optionen</th>
						<th>Preis</th>
						<th>Anzahl</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>';
		$gesamttotal = 0;
		if((isset($this->products)) && (count($this->products) > 0)) {
			foreach ($this->products as $item) {
				$optionsRender = "";
				if($item->getOptions() == "-1"){
					$optionsRender = "Keine Optionen";
				}
				else{
					foreach($item->getOptions() as $option){
						$optionsRender = $optionsRender . $option->getName() .': '. $option->getValue() .', +'. $option->getPrice() .' CHF<br>';
					}
				}
				$product = $item->getProduct();
				$total = $item->getTotal();
				$gesamttotal = $gesamttotal + $total;
				$out = $out . '<tr>
				<td><form method="post" class="pure-form" >
				<input type="hidden" name="id" value="'.$item->getId().'">
				<button type="button" class="addItem pure-button">+</button>
				<button type="button" class="removeItem pure-button">-</button>
				</form></td>
				<td>'.$product->getName(). '  </td>
				<td>'.$optionsRender.'</td>
				<td>'.$item->getPrice().' CHF </td>
				<td>'.$item->getQuantity(). ' </td>
				<td>'.$total.' CHF </td>' ;
			}
			$out = $out . '</tbody>
			
			<tfoot>
			<tr>
			<td colspan="6"> '.$gesamttotal.' CHF </td>
			</tr>
			</tfoot>
			
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
					<th>'.$_SESSION['lang']->getText("cart_table_header_count").'</th>
					<th>'.$_SESSION['lang']->getText("cart_table_header_name").'</th>
					<th>'.$_SESSION['lang']->getText("cart_table_header_total").'</th>
				</tr>
				</thead>
				<tbody>';
		$gesamttotal = 0;
		if((isset($this->products)) && (count($this->products) > 0)) {
			foreach ($this->products as $item) {
				$product = $item->getProduct();
				$total = $item->getTotal();
				$gesamttotal = $gesamttotal + $total;
				$out = $out . '<tr>
				<td>'.$item->getQuantity(). ' </td>
				<td>'.$product->getName(). '  </td>
				<td>'.$total.' CHF </td>
				</tr>';
			}
			$out = $out . '</tbody>
			
			<tfoot>
			<tr>
			<td colspan="5"> '.$gesamttotal.' CHF </td>
			</tr>
			</tfoot>
			
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
	
	public function getNextItemId(){
		return $this->item_count++;
	}
	
}

?>