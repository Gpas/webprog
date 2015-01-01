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

<?php echo $message ?>

<!--<div id="dialog" title="AGB Zustimmung">
	<p>Damit der Kaufvorgang abgeschlossen werden kann, müssen Sie den AGB zustimmen.</p>
</div>-->
