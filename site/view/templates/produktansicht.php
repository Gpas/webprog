<?php
		echo '
		<script>
			$(document).ready(function(){
					$(".order").on("click", function(){
							$.post("index.php?action=addProduct",
							$(this).parent().serialize(),
							function sucess(data){
								data = JSON.parse(data);
								$("#warenkorb").html(data.sidebar);
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
	 			<form class="orderProduct pure-form" method="post" >
					<section class="count"><label>Anzahl<select name="quantity">';
		for ($i=1; $i <= 10 ; $i++) { 
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select></label></section>';
		foreach($options as $option){
			echo $option->render();
		}
		echo '	<input type="hidden" name="id" value='.$product->getId().' />
				<br>
				<button class="order pure-button pure-button-primary" name="addProduct" type="button">In den Warenkorb</button>
				</form>
				</article>';
?>
