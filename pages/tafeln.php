<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/css/main.css" >
        <title>Schoggi Shop</title>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/navigation.php'; ?>
    </head>
    <body>
        <header>
            <img id="logo" src="/resource/logo.jpg" />
            <div id="slider">
                <div class="container">
                    <img class='photo'  src="/resource/pralinen.jpg" alt="" />
                    <img class='photo'  src="/resource/schokolade_stapel.jpg" alt="" />
                    <img class='photo'  src="/resource/schokoladen_bleche.jpg" alt="" />
                </div>
            </div>
        </header>
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
            
            <article>
                <section id="location">
					<?php
						$crumbs = explode("/",$_SERVER["REQUEST_URI"]);
						foreach($crumbs as $crumb){
    					echo ucfirst(str_replace(array(".php","_","pages"),array(""," ",""),$crumb) . ' ');
						}
					?>
                </section>
                <section id="content" >
                    Content
                </section>
            </article>
            
        </main>
        
        <footer>Footer</footer>
    </body>
</html>