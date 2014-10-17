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
								'/index.php?Id=tafeln',
								'/index.php?Id=pralinen',
								'/index.php?Id=zutaten',
								'/index.php?Id=zubehoer',
								'/index.php?Id=kontakt'
							);
						}
						else if ($location == "aside") {
							$pages = array(
				    			'Warenkorb',
				    			'Account',
							);
							$links= array(
								'/index.php?Id=warenkorb',
								'/index.php?Id=account'
							);
						}
						for($i = 0; $i < count($pages); $i++ )
						{
							$nav[$i][0] = $pages[$i];
							$nav[$i][1] = $links[$i];
						}
						foreach($nav as $element){
							$name = substr($element[1], strpos($element[1], "Id=")+3);
							//ChromePhp::log("".$name." ".$_GET['Id']."");
							if((!isset($_GET['Id'])) && ($element[0] == "Home")){
								echo '<li><a class="active" href="'.$element[1].'">'.$element[0].'</a></li>';
							}
							else if((isset($_GET['Id'])) && (strpos($_GET['Id'], strtolower($name)) !== FALSE))
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