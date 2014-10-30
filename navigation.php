<?php
			    	function create_nav ($location) {
			    		if($location == "nav")
			    		{
				    		$pages = array(
				    			'Home',
				    			'Tafeln',
				    			'Pralinen',
				    			'Zutaten',
				    			'Zubehör',
				    			'Kontakt'
							);
							$links= array(
								'/index.php',
								'/index.php?page=tafeln',
								'/index.php?page=pralinen',
								'/index.php?page=zutaten',
								'/index.php?page=zubehoer',
								'/index.php?page=kontakt'
							);
						}
						else if ($location == "aside") {
							$pages = array(
				    			'Warenkorb',
				    			'Account',
							);
							$links= array(
								'/index.php?page=warenkorb',
								'/index.php?page=account'
							);
						}
						for($i = 0; $i < count($pages); $i++ )
						{
							$nav[$i][0] = $pages[$i];
							$nav[$i][1] = $links[$i];
						}
						foreach($nav as $element){
							$name = substr($element[1], strpos($element[1], "page=")+5);
							//ChromePhp::log("".$name." ".$_GET['page']."");
							if((!isset($_GET['page'])) && ($element[0] == "Home")){
								echo '<li><a class="active" href="'.$element[1].'">'.$element[0].'</a></li>';
							}
							else if((isset($_GET['page'])) && (strpos($_GET['page'], strtolower($name)) !== FALSE))
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