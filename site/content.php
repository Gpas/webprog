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
				/* Muss noch angepasst werden. 
				Location muss hier eingefügt werden */
			?>
		</section>
		<section id="content" >
			<?php include($innerTpl) ?>
		</section>
	</article>	
</main>