<?php
	for ($e=1; $e <= 8 ; $e++) { 
		echo '<article class="product">
				<h3>Produkttitel</h3>
				<img alt="Produktbild" src="/resource/logo.jpg">
				<section class="description">
					Produktbeschreibung
				</section>
	 			<form class="orderProduct" method="post" action="/index.php?page=warenkorb">
					<select name="quantity">';
		for ($i=1; $i <= 10 ; $i++) { 
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select>
				<input type="hidden" name="id" value='.$e.' />
				<button type="submit" name="addProduct" >Bestellen</button>
				</form>
				</article>';
	}
?>

