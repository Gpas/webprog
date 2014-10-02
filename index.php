<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/main.css" >
		<title>Schoggi Shop</title>
	</head>
	<body>
		<header>
			<section id="logo">Logo</section>
			<section id="news">News</section>
		</header>
		<main>
			<nav>
			    <ul>
			    	<?php
			    		$pages = glob('pages/*');
						foreach ($pages as $page)
						{
							echo '<li><a href="'.$page.'">'.$page.'</a></li>';
						}
			    	?>
				</ul>
			</nav>
			<section id="content">
				<section id="location">
					Location
				</section>
				Main
			</section>
			<aside>
				<ul>
                    <li><a href="account.html">Account</a></li>
                    <li><a href="warenkorb.html">Warenkorb</a></li>
                </ul>
			</aside>
		</main>
	</body>
</html>