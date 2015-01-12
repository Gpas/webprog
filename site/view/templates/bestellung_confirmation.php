
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
			$total = $product->getTotal();
			$gesamttotal = $gesamttotal + $total;
			echo '
				<tr>
					<td>'.$product->getProduct()->getId().'</td>
					<td>'.$product->getProduct()->getName().'</td>
					<td>'.$product->getPrice().' CHF</td>
					<td>'.$product->getQuantity().'</td>
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



<br>
<button type="button" id="opener" class="pure-button pure-button-primary">Abschicken </button>

<div id="dialog" title="AGB Zustimmung">
	<p>Damit der Kaufvorgang abgeschlossen werden kann, müssen Sie den AGB zustimmen.</p>
</div>

<script>
	$(function() {
		$("#dialog").dialog({
			autoOpen: false,
			modal: true,
			buttons: [
				{
					text: "Zustimmen",
					click:	function(){
						$(this).dialog("close");
						location.replace("index.php?action=abschicken");
					}			
				},
				{
					text: "Abbrechen",
					click:	function(){
						$(this).dialog("close");	
					}		
				}
			]
		});
		$( "#opener" ).click(function() {
      		$( "#dialog" ).dialog( "open" );
    	});
	});	
</script>
