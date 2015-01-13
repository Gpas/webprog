
<h3>Bestellübersicht</h3>
<h4>Produkteliste</h4>
<table class="pure-table pure-table-horizontal pure-table-striped" >
<thead>
	<tr>
		<th>ProdNr</th>
		<th>Name</th>
		<th>Optionen</th>
		<th>Preis</th>
		<th>Anzahl</th>
		<th>Total</th>
	</tr>
</thead>

<tbody>
<?php

		$gesamttotal = 0;
		foreach ($products as $item){
			$optionsRender = "";
			if($item->getOptions() == "-1"){
				$optionsRender = "Keine Optionen";
			}
			else{
				foreach($item->getOptions() as $option){
					$optionsRender = $optionsRender . $option->getName() .': '. $option->getValue() .', +'. $option->getPrice() .' CHF<br>';
				}
			}
			$total = $item->getTotal();
			$gesamttotal = $gesamttotal + $total;
			echo '
				<tr>
					<td>'.$item->getProduct()->getId().'</td>
					<td>'.$item->getProduct()->getName().'</td>
					<td>'.$optionsRender.'</td>
					<td>'.$item->getPrice().' CHF</td>
					<td>'.$item->getQuantity().'</td>
					<td>'.$total.' CHF</td>
				</tr>
			';
		}
		
		echo '
		</tbody>
		
		<tfoot>
		<tr>
		<td colspan="6"> '.$gesamttotal.' CHF </td>
		</tr>
		</tfoot>
		';
?>




</table>
<h3>Personenangaben</h3>
<h4>Lieferadresse</h4>
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
			<h3>Zahlungsart</h3>
			'.$zahlungsart.'
		';
		
?>



<br><br>
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
