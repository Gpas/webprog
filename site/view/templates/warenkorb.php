		<script>
			$(document).ready(function(){
					//Sidebar Warenkorb löschen wenn man im Warenkorb ist.
					var elem = document.getElementById("warenkorb");
   					elem.parentNode.removeChild(elem);
					$("#clearCart").on("click", function(){
							$.post("index.php?action=clearCart",
							function sucess(){
								location.reload();
							}
						);
					});
					$("#warenkorb_gross").on("click", ".addItem", function(){
							$.post("index.php?action=addItem",
							$(this).parent().serialize(),
							function sucess(data){
								data = JSON.parse(data);
								$("#warenkorb_gross").html(data.render);
							}
						);
					});
					$("#warenkorb_gross").on("click", ".removeItem", function(){
							$.post("index.php?action=removeItem",
							$(this).parent().serialize(),
							function sucess(data){
								data = JSON.parse(data);
								$("#warenkorb_gross").html(data.render);
							}
						);
					});
			});
		</script>
		
	


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

<button type="button" class="pure-button" name="clearCart" id="clearCart"
<?php 
		if(count($cart->getProducts()) <= 0){
			echo "disabled" ;
		} 
	?>>Warenkorb leeren</button>

<form method="post" action="/index.php?action=bestellung">
	<input class="pure-button pure-button-primary button-xlarge" type="submit" value="Bestellen" <?php 
		if(count($cart->getProducts()) <= 0){
			echo "disabled" ;
		} 
	?> />
</form>



