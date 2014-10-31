<main>
	<nav>
	    <ul>
		   <?php
				create_nav("nav");
		   ?> 
		</ul>
	</nav>
	<aside>
	    <ul>
	       <?php
				create_nav("aside");
		   ?>
	    </ul>
	</aside>
	
	<article id="mainArticle">
		<section id="location">
			<?php
				/* Muss noch angepasst werden. */
				$crumbs = explode("/",$_SERVER["REQUEST_URI"]);
				foreach($crumbs as $crumb){
				echo ucfirst(str_replace(array(".php","_","pages"),array(""," ",""),$crumb) . ' ');
				}
			?>
		</section>
		<section id="content" >
			<?php
				if(isset($_GET['page'])) {
					$page = $_GET['page'];
					include "/pages/$page.php";
				}
				else {
					include "/pages/home.php";
				}
			?>
		</section>
	</article>	
</main>