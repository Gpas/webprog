<?php
	displayProducts($_GET["page"]);
	
	$products = ProdukteQuery::create()->find();
	foreach ($products as $product) {
		echo $product->getName();
	}
?>
