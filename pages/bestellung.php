<?php 
	if(isset($_GET['confirmation']) && $_GET['confirmation'] == TRUE){
		session_start();
		echo '<h3>Bestellübersicht</h3>
			<h4>Produkteliste</h4>
			<table>
				<caption>Produkteliste</caption>
			<tr>
				<th>ProdNr</th>
				<th>Name</th>
				<th>Preis</th>
				<th>Anzahl</th>
				<th>Total</th>
			</tr>
			';
		foreach ($_SESSION['cart'] as $product){
			$result = $mysqli->query('SELECT * FROM produkte WHERE ID="'.$product['id'].'"'); 
			$row = $result->fetch_assoc();
			$total = $product['quantity'] * $row['Preis'];
			echo '
				<tr>
					<td>'.$product['id'].'</td>
					<td>'.$row['Name'].'</td>
					<td>'.$row['Preis'].' CHF</td>
					<td>'.$product['quantity'].'</td>
					<td>'.$total.'</td>
				</tr>
			';
		}
		echo '
			</table>
			<h4>Lieferadresse</h4>
		';
		foreach ($_POST['person'] as $key => $value) {
			//todo
		}
		var_dump($_POST);	
	}
	else {
		echo '
<form method="post" action="/index.php?page=bestellung&confirmation=TRUE">
	<p>
		<label>Anrede:</label>
		<select name="person[anrede]">
			<option value="herr">Herr</option>
			<option value="frau">Frau</option>
			<option value="familie">Familie</option>			
		</select>
	</p> 
	<p>
		<label>Vorname:</label>
		<input name="person[vorname]" />
	</p>
	<p>
		<label>Nachname:</label>
		<input name="person[nachname]" />
	</p>
	<p>
		<label>Strasse:</label>
		<input name="person[strasse]" />
	</p>
	<p>
		<label>PLZ:</label>
		<input name="person[plz]" />
	</p>
	<p>
		<label>Ort:</label>
		<input name="person[ort]" />
	</p>
	<p>
		<label>E-Mail:</label>
		<input type="mail" name="person[email]" />
	</p>
	<p>
		<label>Telefon:</label>
		<input type="tel" name="person[telefon]" />
	</p>
	<p>
		<label>Bemerkung:</label><br/>
		<textarea name="bemerkung" rows="8" cols="40"></textarea> 
	</p>
	<p>
		<label>Zahlungsart:</label><br/>
		<input type="radio" name="zahlungsart" value="vorauskasse" />Vorauskasse<br/>
		<input type="radio" name="zahlungsart" value="rechnung" />Rechnung<br/>
		<input type="radio" name="zahlungsart" value="kreditkarte" />Kreditkarte<br/>
		<input type="radio" name="zahlungsart" value="paypal" />PayPal Zahlung<br/>
		<input type="radio" name="zahlungsart" value="postfinance" />Postfinance E-Finance<br/>
	</p>
	<p>
		<input type="submit" value="Weiter zur Bestellübersicht" />
	</p>
</form>
		';
	}
?>