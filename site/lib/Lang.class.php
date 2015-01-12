<?php
	
	class Lang{
		
		private $content;
		private $fallback;
		
		public function __construct($lang="de"){
			$this->loadLang($lang);
			setcookie("lang", $lang, time()+2592000); // 30 Tage
			if(empty($_SESSION['lang'])) {
				$_SESSION['lang'] = $this;
			}
		}
		
		public function loadLang($lang){
			$path = __DIR__ . "\..\assets\lang\\";
			if($lang != "de"){
				$this->fallback = parse_ini_file($path . "de");
			}
			$filename = $path . $lang;
			$this->content = parse_ini_file($filename);
		}
		
		public function getText($key){
			if(isset($this->content[$key])){
				return $this->content[$key];
			}
			else if(isset($this->fallback[$key])){
				return $this->fallback[$key];
			}
			else {
				return "missing key \"".$key."\"";
			}
			
		}
		
	}
	
?>
