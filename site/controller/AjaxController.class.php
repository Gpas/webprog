<?php 

class AjaxController {
	
	private $data = array();
	private $sessionState = false;
	
	// A C T I O N S
	
	public function addProduct(Request $request){
		$this->startSession();
		$id = $request->getParameter('id','null');
		$quantity = $request->getParameter('quantity','1');
		$options = $request->getParameter('options', '-1');
		$cart = $_SESSION['cart'];
		/*if(is_string($options) && $options != "-1"){
			$options = unserialize($options);
		}*/
		$cart->addProduct($id, $quantity, $options);
		echo json_encode(array("sidebar" => $cart->renderSidebar()));
	}
	
	public function removeItem(Request $request){
		$this->startSession();
		$id = $request->getParameter('id','null');
		$cart = $_SESSION['cart'];
		$cart->removeItem($id);
		echo json_encode(array("render" => $cart->render()));
	}
	
	public function addItem(Request $request){
		$this->startSession();
		$id = $request->getParameter('id','null');
		$cart = $_SESSION['cart'];
		$cart->addItem($id);
		echo json_encode(array("render" => $cart->render()));
	}
	
	public function clearCart(Request $request){
		$this->startSession();
		$_SESSION['cart']->reset();
	}
	
	public function changeLang(Request $request){
		$this->startSession();
		new Lang();
		$_SESSION['cart']->reload();
	}
	
	public function __call($function, $args) {
		throw new Exception("The action '$function' does not exist!");
	}

	
	// H E L P E R S
	
	public function &getData() {
		return $this->data;
	}
	

	// P R I V A T E  H E L P E R S
	private function startSession(){
		if ($this->sessionState == false ) {
			$this->sessionState = session_start();
		}
	}
	
	private function redirect($action) {
		header("Location: index.php?action=$action");
	}
	
	private function internalRedirect($action, $request) {
		$tpl = $this->$action($request);
		return $tpl ? $tpl : $action;
	}
	
	private function page404() {
		header("HTTP/1.1 404 Not Found");
		return "page404";
	}
	
}

?>









