<?php
			    	function create_nav ($location) {
			    		if($location == "nav")
			    		{
				    		$pages = array(
				    			$_SESSION['lang']->getText("nav_item_1"),
				    			$_SESSION['lang']->getText("nav_item_2"),
				    			$_SESSION['lang']->getText("nav_item_3"),
				    			$_SESSION['lang']->getText("nav_item_4"),
				    			$_SESSION['lang']->getText("nav_item_5"),
				    			$_SESSION['lang']->getText("nav_item_6")
							);
							$links= array(
								'/index.php',
								'/index.php?action=tafeln',
								'/index.php?action=pralinen',
								'/index.php?action=zutaten',
								'/index.php?action=zubehoer',
								'/index.php?action=kontakt'
							);
						}
						else if ($location == "aside") {
							$pages = array(
				    			$_SESSION['lang']->getText("nav_item_7"),
				    			$_SESSION['lang']->getText("nav_item_8")
							);
							$links= array(
								'/index.php?action=account',
								'/index.php?action=warenkorb'
							);
						}
						for($i = 0; $i < count($pages); $i++ )
						{
							$nav[$i][0] = $pages[$i];
							$nav[$i][1] = $links[$i];
						}
						foreach($nav as $element){
							$name = substr($element[1], strpos($element[1], "action=")+7);
							if((!isset($_GET['action'])) && ($element[0] == "Home")){
								echo '<li><a class="active" href="'.$element[1].'">'.$element[0].'</a></li>';
							}
							else if((isset($_GET['action'])) && (strpos($_GET['action'], strtolower($name)) !== FALSE))
							{

								echo '<li><a class="active" href="'.$element[1].'">'.$element[0].'</a></li>';	
							}
							else
							{
								echo '<li><a href="'.$element[1].'">'.$element[0].'</a></li>';
							}
						}
					}
?>