<?php 
	if(isset($_GET['confirmation']) && $_GET['confirmation'] == TRUE){
		session_start();
		echo '<h3>Bestellübersicht</h3>
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
			';
		foreach ($_SESSION['cart'] as $product){
			$result = DB::doQuery('SELECT * FROM products WHERE id="'.$product['id'].'"'); 
			$row = $result->fetch_assoc();
			$total = $product['quantity'] * $row['price'];
			echo '
				<tr>
					<td>'.$product['id'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['price'].' CHF</td>
					<td>'.$product['quantity'].'</td>
					<td>'.$total.' CHF</td>
				</tr>
			';
		}
		$person = $_POST['person'];
		echo '
			</tbody>
			</table>
			<h4>Personenangaben</h4>
			<h5>Lieferadresse</h5>
			<address>
				'.$person["anrede"].' <br>
				'.$person["vorname"].' '.$person["nachname"].' <br>
				'.$person["strasse"].' <br>
				'.$person["plz"].' '.$person["ort"].'
			</address>
			<br>
			E-Mailadresse: '.$person["email"].' <br>
			Telefon: '.$person["telefon"].' <br>
		';
		if($_POST['bemerkung'] !== ""){
			echo 'Bemerkung: '.$_POST['bemerkung'];
		}
		echo '
			<h4>Zahlungsart</h4>
			'.$_POST['zahlungsart'].'
		';
	}
	else {
		echo '
<form class="pure-form pure-form-stacked" method="post" action="/index.php?action=bestellung&confirmation=TRUE">
	<fieldset>
		<legend>Personenangaben</legend>
		<p>
			<label>Anrede:</label>
			<select name="person[anrede]">
				<option value="Herr">Herr</option>
				<option value="Frau">Frau</option>
				<option value="Familie">Familie</option>			
			</select>
		</p> 
		<p>
			<label>Vorname:</label>
			<input name="person[vorname]" required />
		</p>
		<p>
			<label>Nachname:</label>
			<input name="person[nachname]" required />
		</p>
		<p>
			<label>Strasse:</label>
			<input name="person[strasse]" required />
		</p>
		<p>
			<label>PLZ:</label>
			<input name="person[plz]" required />
		</p>
		<p>
			<label>Ort:</label>
			<input name="person[ort]" required />
		</p>
		<p>
			<label>E-Mail:</label>
			<input type="email" name="person[email]" required />
		</p>
		<p>
			<label>Telefon:</label>
			<input type="tel" name="person[telefon]" required />
		</p>
	</fieldset>
	<fieldset>
		<legend>Zahlungsart</legend>
		<p>
			<label class="pure-radio"><input type="radio" name="zahlungsart" value="Vorauskasse" required/> Vorauskasse</label>
			<label class="pure-radio"><input type="radio" name="zahlungsart" value="Rechnung" /> Rechnung</label>
			<label class="pure-radio"><input type="radio" name="zahlungsart" value="Kreditkarte" /> Kreditkarte</label>
			<label class="pure-radio"><input type="radio" name="zahlungsart" value="Paypal" /> PayPal Zahlung</label>
			<label class="pure-radio"><input type="radio" name="zahlungsart" value="Postfinance" /> Postfinance E-Finance</label>
		</p>
	</fieldset>
	<p>
		<label>Bemerkung:</label><br/>
		<textarea name="bemerkung" rows="8" cols="40"></textarea> 
	</p>
	<p>
		<input class="pure-button pure-button-primary" type="submit" value="Weiter zur Bestellübersicht" />
	</p>
</form>
		';
	}
?>