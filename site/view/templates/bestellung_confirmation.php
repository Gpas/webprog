
<h3>Bestellübersicht</h3>
<h4>Produkteliste</h4>
<table class="pure-table pure-table-horizontal" >
<thead>
	<tr>
		<th>ProdNr</th>
		<th>Name</th>
		<th>Preis</th>
		<th>Anzahl</th>
		<th>Total</th>
	</tr>
</thead>

<tbody>
<?php

		$gesamttotal = 0;
		foreach ($products as $product){
			$result = Product::getProductbyId($product['id']); 
			$total = $product['quantity'] * $result->getPrice();
			$gesamttotal = $gesamttotal + $total;
			echo '
				<tr>
					<td>'.$product['id'].'</td>
					<td>'.$result->getName().'</td>
					<td>'.$result->getPrice().' CHF</td>
					<td>'.$product['quantity'].'</td>
					<td>'.$total.' CHF</td>
				</tr>
			';
		}
		
		echo '
		</tbody>
		
		<tfoot>
		<tr>
		<td colspan="5"> '.$gesamttotal.' CHF </td>
		</tr>
		</tfoot>
		';
?>




</table>
<h4>Personenangaben</h4>
<h5>Lieferadresse</h5>
<address>
	<?php
	echo
	$person["anrede"].' <br>
	'.$person["vorname"].' '.$person["nachname"].' <br>
	'.$person["strasse"].' <br>
	'.$person["plz"].' '.$person["ort"].'
</address>
<br>
			E-Mailadresse: '.$person["email"].' <br>
			Telefon: '.$person["telefon"].' <br>
		';

		echo 'Bemerkung: '.$bemerkung.'<br>
			<h4>Zahlungsart</h4>
			'.$zahlungsart.'
		';
?>