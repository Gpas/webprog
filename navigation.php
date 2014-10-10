<?php
			    	function create_nav ($location) {
			    		if($location == "nav")
			    		{
				    		$pages = array(
				    			'Index',
				    			'Tafeln',
				    			'Pralinen',
				    			'Zutaten',
				    			'Zubehör',
				    			'Kontakt'
							);
							$links= array(
								'/index.php',
								'/pages/tafeln.php',
								'/pages/Pralinen/pralinen.php',
								'/zutaten.html',
								'/zubehör.html',
								'/kontakt.html'
							);
						}
						else if ($location == "aside") {
							$pages = array(
				    			'Warenkorb',
				    			'Account',
							);
							$links= array(
								'/warenkorb.php',
								'/account.php',
							);
						}
						for($i = 0; $i < count($pages); $i++ )
						{
							$nav[$i][0] = $pages[$i];
							$nav[$i][1] = $links[$i];
						}
						foreach($nav as $element){
							if(strpos($_SERVER["REQUEST_URI"], strtolower($element[0])))
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