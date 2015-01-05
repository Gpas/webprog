<?php
		echo '
		<script>
	$(document).ready(function(){
			$(".order").on("click", function(){
					$.post("index.php?action=addProduct",
					$(".orderProduct").serialize(),
					function sucess(data){
						$("#warenkorb").load("index.php?action=renderSideCart");
					}
				);
			});
	});
</script>
		';
		
		echo '<article class="productdetail">
				<h1>'.$product->getName().'</h1>
				<img alt="Produktbild" src="/assets/images/'.$product->getImg().'">
				<section class="description">
					'.$product->getDescription().'
				</section>
				<section class="price">
				Preis: '.$product->getPrice().' CHF
				</section>
	 			<form class="orderProduct" method="post" >
					<select name="quantity">';
		for ($i=1; $i <= 10 ; $i++) { 
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select>
				<input type="hidden" name="id" value='.$product->getId().' />
				<button class="order" name="addProduct" type="button">Bestellen</button>
				</form>
				</article>';
?>
