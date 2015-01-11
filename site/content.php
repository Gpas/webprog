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
		   <section id="warenkorb">
		   	<?php 
		   		echo $_SESSION['cart']->renderSidebar();
		   	?>
		   </section>
	    </ul>
	</aside>
	<article id="mainArticle">
		<section id="content" >
			<?php include($innerTpl) ?>
		</section>
	</article>	
</main>