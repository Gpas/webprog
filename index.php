<?php
$username = "root";
$password = "";
$hostname = "localhost";
$database = "web_prog";

$mysqli = new mysqli($hostname, $username, $password, $database);
$mysqli->query("SET NAMES 'utf8'"); 

function displayProducts($category) {
	$result = $GLOBALS["mysqli"]->query('SELECT * FROM produkte WHERE Kategorie = "'.$category.'"');
	
	if (isset($result) && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<article class="product">
				<h3>'.$row["Name"].'</h3>
				<img alt="Produktbild" src="'.$row["Bild"].'">
				<section class="description">
					'.$row["Beschreibung"].'
				</section>
	 			<form class="orderProduct" method="post" action="/index.php?page=warenkorb">
					<select name="quantity">';
		for ($i=1; $i <= 10 ; $i++) { 
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '</select>
				<input type="hidden" name="id" value='.$row["ID"].' />
				<button type="submit" name="addProduct" >Bestellen</button>
				</form>
				</article>';
    }
	} else {
    	echo "Keine Produkte gefunden!";
	}
}

?>

<!DOCTYPE html>
<html>
	<?php include "ChromePhp.php"; ?>
	<?php include "pages/head.php" ?>
	<body>
		<?php include "pages/header.php" ?>
		<?php include "pages/main.php" ?>
		<?php include "pages/footer.php" ?>
	</body>
</html>



