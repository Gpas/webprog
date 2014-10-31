<script>
	$(function() {
		$("#dialog").dialog({
			buttons: [
				{
					text: "Zustimmen",
					click:	function(){
						$(this).dialog("close");	
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
	});	
</script>

<h1>Willkommen im Schoggi Shop</h1>
<p>
Hier kannst du all deine Schoggi Wünsche erfüllen! 
Und das ganze ohne Versandkosten und extra schneller Lieferung.
</p>
<div id="dialog" title="AGB Zustimmung">
	<p>Damit der Kaufvorgang abgeschlossen werden kann, müssen Sie den AGB zustimmen.</p>
</div>
