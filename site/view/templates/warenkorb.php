
<?php
		echo '
		<script>
			$(document).ready(function(){
					$("#clearCart").on("click", function(){
							$.post("index.php?action=clearCart",
							function sucess(){
								$("#warenkorb_gross").load("index.php?action=renderCart");
								$("#warenkorb").load("index.php?action=renderSideCart");
							}
						);
					});
					$("#warenkorb_gross").on("click", ".addProduct", function(){
							$.post("index.php?action=addProduct",
							$(this).parent().serialize(),
							function sucess(){
								$("#warenkorb_gross").load("index.php?action=renderCart");
								$("#warenkorb").load("index.php?action=renderSideCart");
							}
						);
					});
					$("#warenkorb_gross").on("click", ".removeProduct", function(){
							$.post("index.php?action=removeProduct",
							$(this).parent().serialize(),
							function sucess(){
								$("#warenkorb_gross").load("index.php?action=renderCart");
								$("#warenkorb").load("index.php?action=renderSideCart");
							}
						);
					});
			});
		</script>
		';
	
?>

<style scoped>

		#clearCart, .pure-button-primary {
			margin: 10px 0;
		}
		
		#clearCart {
			color: white;
			background: rgb(223, 117, 20);
		}

        .button-xlarge {
            font-size: 130%;
        }

</style>


<section id="warenkorb_gross"><?php echo $cart->render();?></section>

<button type="button" class="pure-button" name="clearCart" id="clearCart">Warenkorb leeren</button>

<form method="post" action="/index.php?action=bestellung">
	<input class="pure-button pure-button-primary button-xlarge" type="submit" value="Bestellen"  />
</form>


