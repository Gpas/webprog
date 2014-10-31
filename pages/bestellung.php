<body>
	<p><label>Anrede:</label> </label>
		<select name="anrede">
			<option value="herr">Herr</option>
			<option value="frau">Frau</option>
			<option value="famillie">Famillie</option>			
		</select>
	</p> 
	<p>Vorname: <input name"vorname" /></p>
	<p>Nachname: <input name"nachname" /></p>
	<p>Strasse: <input name"strasse" /></p>
	<p>Hausnummer: <input name"hausnummer" /></p>
	<p>PLZ: <input name"postleihzahl" /></p>
	<p>Ort: <input name"ort" /></p>
	<p>E-Mail: <input name"email" /></p>
	<form>
		Bemerkung:<br/>
		<textarea name="bemerkung" rows="8" cols="40">
		</textarea> 
	</form>
	<p>Zahlungsart:</p>
	<input type="radio" name="zahlungsart" value="vorauskasse" />Vorauskasse<br/>
	<input type="radio" name="zahlungsart" value="rechnung" />Rechnung<br/>
    <input type="radio" name="zahlungsart" value="kreditkarte" />Kreditkarte<br/>
	<input type="radio" name="zahlungsart" value="paypal" />PayPal Zahlung<br/>
	<input type="radio" name="zahlungsart" value="postfinance" />Postfinance E-Finance<br/>
</body>