<?php
	if(!empty($products)){
		foreach($products as $product){
			$product->render();
		}
	}
	else{
		echo 'No products found. Try switching to german.';
	}
?>