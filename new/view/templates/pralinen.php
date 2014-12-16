<?php
	foreach($products as $product){
		//echo "$product <br>";
		echo '<article class="product">
				<h3>'.$product->getName().'</h3>
				<img alt="Produktbild" src="/assets/images/'.$product->getImg().'">
				<section class="description">
					'.$product->getDescription().'
				</section>
	 			<form class="orderProduct" method="post" action="/index.php?action=warenkorb">
					<select name="quantity">';
		for ($i=1; $i <= 10 ; $i++) { 
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select>
				<input type="hidden" name="id" value='.$product->getId().' />
				<button type="submit" name="addProduct" >Bestellen</button>
				</form>
				</article>';
	}
?>
