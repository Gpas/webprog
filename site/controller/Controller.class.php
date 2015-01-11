<?php 

class Controller {
	
	private $data = array();
	private $sessionState = true;
	private $title;
	
	// A C T I O N S
	
	public function home(Request $request) {
		$this->data["message"] = "<h1>".$_SESSION['lang']->getText("welcome_title")."</h1>
		<p>
		".$_SESSION['lang']->getText("welcome_message")."
		</p>";
	}
	
	public function bestellung(Request $request) {

	}
	
	public function bestellung_confirmation(Request $request) {
		$this->data['person'] = $request->getParameter('person', '');
		$this->data['bemerkung'] = $request->getParameter('bemerkung', '');
		$this->data['zahlungsart'] = $request->getParameter('zahlungsart', '');
		$cart = $_SESSION['cart'];
		$this->data['products'] = $cart->getProducts();
	}
	
	public function kontakt(Request $request) {
		$this->data["message"] = "<h3>Kontaktadresse</h3>
		<p>
		SchoggiShop GmbH <br>
		Hauptstrasse 23 <br>
		3000 Bern <br>
		Email: info@schoggishop.ch 
		</p>";
	}
	
	public function pralinen(Request $request) {
		$sort = $request->getParameter('sort', 'id');
		$this->data["products"] = Product::getProductsbyCat('pralines', $sort);
		$this->title = "Pralinen";
	}
	
	public function tafeln(Request $request) {
		$sort = $request->getParameter('sort', 'id');
		$this->data["products"] = Product::getProductsbyCat('tafeln', $sort);
		$this->title = "Tafeln";
		
	}
	
	public function produktansicht(Request $request) {
		$id = $request->getParameter('produkt_id', '0');
		$this->data["product"] = Product::getProductbyId($id);
		$this->title = $this->data["product"]->getName();
		$this->data["options"] = Option::getOptionsByProduct($id);
	}
	
	public function warenkorb(Request $request) {
		$this->data["cart"] = $_SESSION['cart'];
		$this->title = "Warenkorb";
	}
	
	public function zubehoer(Request $request) {
		$sort = $request->getParameter('sort', 'id');
		$this->data["products"] = Product::getProductsbyCat('zubehoer', $sort);
		$this->title = "Zubehoer";
	}
	
	public function zutaten(Request $request) {
		$sort = $request->getParameter('sort', 'id');
		$this->data["products"] = Product::getProductsbyCat('zutaten', $sort);
		$this->title = "Zutaten";
			
		
		
	}
	
	public function account(Request $request) {
		$this->startSession();
		if (isset($_SESSION['user'])){
			$user = $_SESSION['user'];
			$this->data['message'] = "Du bist eingeloggt als ".$user->getName().".";
		}
		else {
			return "account_login";
		}
	}
	
	public function login(Request $request) {
		$login = $request->getParameter('login', '');
		$pw = $request->getParameter('pw', '');
		$user = User::login($login, $pw);
		if (!$user) {
			$this->data['message'] = "Sorry, falsches login/pw!";
			return "account_login";
		}
		$this->startSession();
		$_SESSION['user'] = $user;
		$this->data['message'] = "Du bist eingeloggt als ".$user->getName()."!";
		return "account";	
		
	}
		
	public function logout(Request $request) {
		$this->startSession();
		unset($_SESSION['user']);
		$this->data['message'] = "Du hast dich erfolgreich ausgeloggt!";
		return "home";
	}
	
	public function addProduct(Request $request){
		$id = $request->getParameter('id','null');
		$quantity = $request->getParameter('quantity','1');
		$options = $request->getParameter('options', '-1');
		$cart = $_SESSION['cart'];
		if(is_string($options) && $options != "-1"){
			$options = unserialize($options);
		}
		$cart->addProduct($id, $quantity, $options);
		echo json_encode(array("sidebar" => $cart->renderSidebar()));
		return "noView";
	}
	
	public function removeItem(Request $request){
		$id = $request->getParameter('id','null');
		$cart = $_SESSION['cart'];
		$cart->removeItem($id);
		echo json_encode(array("render" => $cart->render()));
		return "noView";
	}
	
	public function addItem(Request $request){
		$id = $request->getParameter('id','null');
		$cart = $_SESSION['cart'];
		$cart->addItem($id);
		echo json_encode(array("render" => $cart->render()));
		return "noView";
	}
	
	public function clearCart(Request $request){
		$_SESSION['cart']->reset();
		return "noView";
	}
	
	public function changeLang(Request $request){
		unset($_SESSION['lang']);
		new Lang($request->getParameter('lang', 'de'));
		$_SESSION['cart']->reload();
		return "noView";
	}
	
	public function __call($function, $args) {
		throw new Exception("The action '$function' does not exist!");
	}

	
	// H E L P E R S
	
	public function &getData() {
		return $this->data;
	}
	
	public function isLoggedIn() {
		$this->startSession();
		return isset($_SESSION["user"]);
	}
	
	public function getTitle() {
		return $this->title;
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









