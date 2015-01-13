<?php
	
	class Lang{
		
		private $content;
		private $fallback;
		
		public function __construct(){
			if(isset($_COOKIE['lang'])){
				$this->loadLang($_COOKIE['lang']);
			}
			else{
				$this->loadLang('de');
			}
			$_SESSION['lang'] = $this;
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
