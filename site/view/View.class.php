<?php 

class View {
	
	private $controller;
	
	public function __construct(Controller $controller) {
		$this->controller = $controller;
	}
	
	public function render($tpl) {
		if($tpl != "noView"){
			$innerTpl = __DIR__ ."/templates/$tpl.php";
			if(!file_exists($innerTpl)) {
				throw new Exception("The template '$tpl.php' does not exist!");
			}
			foreach($this->controller->getData() as $key=>$value) {
				$$key = $value;
			}
			$title = $this->controller->getTitle();
			$title = $title ? "Schoggi Shop - " . $title : "Schoggi Shop";
			include __DIR__ ."/templates/main.php";
		}
	}
}
