
	
	<h3>Bitte einloggen</h3>
	<?php echo isset($message) ? "<h5>".$message."</h5>" : ""; ?>
	<form class="pure-form pure-form-stacked" action="index.php?action=login" method="post">
		<p><label>Name</label> <input name="login"></p>
		<p><label>Password</label> <input type="password" name="pw"></p>
		<p><input class="pure-button pure-button-primary" type="submit" value="Login"></p>
	</form>
	<br>
	<a href="index.php?action=account_register">Noch kein Account? Klicke hier!</a>
	