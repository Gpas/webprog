<?php

	if(isset($product)){
		echo '<article class="productdetail">
			<h1>'.$product->getName().'</h1>
			<img alt="Produktbild" src="/assets/images/'.$product->getImg().'">
			<section class="description">
				'.$product->getDescription().'
			</section>
			<section class="price">
			'.$_SESSION['lang']->getText("product_price").': '.$product->getPrice().' CHF
			</section>
			<form class="orderProduct pure-form" method="post" >
				<section class="count"><label>'.$_SESSION['lang']->getText("product_count").'<select name="quantity">';
		for ($i=1; $i <= 10 ; $i++) { 
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select></label></section>';
		foreach($options as $option){
			echo $option->render();
		}
		echo '	<input type="hidden" name="id" value='.$product->getId().' />
				<br>
				<button class="order pure-button pure-button-primary" name="addProduct" type="button">'.$_SESSION['lang']->getText("product_addToCart").'</button>
				</form>
				</article>';
	}
	else{
		echo "This product is not available in your language. Please switch to German.";
	}

?>

<script>
	$(document).ready(function(){
			$(".order").on("click", function(){
					$.post("ajax.php?action=addProduct",
					$(this).parent().serialize(),
					function sucess(data){
						data = JSON.parse(data);
						$("#warenkorb").html(data.sidebar);
					}
				);
			});
	});
</script>
