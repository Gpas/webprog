<?php

session_start();

if(empty($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}

if (isset($_POST['id'])) {
	$duplicate = FALSE;
	$product = array('id' => $_POST['id'],
					'quantity' => $_POST['quantity']);
	foreach ($_SESSION['cart'] as $prod => $content){
		if ($content['id'] == $product['id']) {
			$_SESSION['cart'][$prod]['quantity'] += $product['quantity'];
			$duplicate = TRUE;
		}
	}
	if (!$duplicate) {
		array_push($_SESSION['cart'], $product);
	}
}

foreach ($_SESSION['cart'] as $product) {
	echo 'Produkt '.$product["id"].' ist '.$product["quantity"].' mal im Warenkorb <br>
		<form method="post" action="/index.php?page=warenkorb">
		 <input type="submit" name="additem" value="+" />
		</form>
		
		<form method="post" action="/index.php?page=warenkorb">
		 <input type="submit" name="removeitem" value="-" />
		</form>
		 ';
	
}

if (isset($_POST['removeitem'])) {
	
}

if (isset($_POST['additem'])) {
	
}

// Session löschen (evt mit Javascript machen)
echo '<form method="post" action="/index.php?page=warenkorb">
		 <input type="submit" name="unset" value="Warenkorb leeren" />
		</form>
		 ';
if (isset($_POST['unset'])) {
	unset($_SESSION['cart']);
}

?>



<form method="post" action="/index.php?page=bestellung">
	<input type="submit" value="Bestellen"  />
</form>