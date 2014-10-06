<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/main.css" >
		<title>Schoggi Shop</title>
	</head>
	<body>
		<header>
			<img id="logo" src="../resource/logo.jpg" />
			<div id="slider">Slider</div>
		</header>
		<main>
			<nav>
			    <ul>
				    <?php
			    		$pages = array(
			    			'Home',
			    			'Tafeln',
			    			'Pralinen',
			    			'Zutaten',
			    			'Zubehör',
			    			'Kontakt'
						);
						$links= array(
							'index.php',
							'tafeln.html',
							'pralinen.html',
							'zutaten.html',
							'zubehör.html',
							'kontakt.html'
						);
						for($i = 0; $i < count($pages); $i++ )
						{
							$nav[$i][0] = $pages[$i];
							$nav[$i][1] = $links[$i];
						}
						foreach($nav as $element){
							echo '<li><a href="'.$element[1].'">'.$element[0].'</a></li>';
						}
			    	?>
				</ul>
			</nav>
			<aside>
                <ul>
                    <li><a href="account.html">Account</a></li>
                    <li><a href="warenkorb.html">Warenkorb</a></li>
                </ul>
            </aside>
			
			<article>
				<section id="location">
					Location
				</section>
				<section id="content" >
				    Content
				</section>
			</article>
			
		</main>
		
		<footer>Footer</footer>
	</body>
</html>