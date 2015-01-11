
<h2>Accountdetails</h2>
<?php echo isset($message) ? "<p>".$message."</p>" : ""; ?>
	<form action="index.php?action=logout" method="post">
		<p><input class="pure-button pure-button-primary" type="submit" value="Ausloggen"></p>
	</form>