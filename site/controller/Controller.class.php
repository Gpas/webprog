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
	
	public function abschicken(Request $request) {
		$this->data["message"] = "Vielen Dank für ihre Bestellung, welche nicht bearbeitet wird.";
		$_SESSION['cart']->reset();
		return "home";
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
		if(isset($this->data['product'])){
			$this->title = $this->data["product"]->getName();
			$this->data["options"] = Option::getOptionsByProduct($id);
		}
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
	
	public function account_register(Request $request){
		
	}
	
	public function createAccount(Request $request){
		$pw = $request->getParameter("pw", null);
		$name = $request->getParameter("login", null);
		if(User::create($name, $pw)){
			return $this->internalRedirect("login", $request);
		}
		else{
			$this->data['message'] = "Dieser Benutzername wird schon verwendet";
			return "account_register";
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
		return $this->internalRedirect("account", $request);		
	}
		
	public function logout(Request $request) {
		$this->startSession();
		unset($_SESSION['user']);
		$this->data['message'] = "Du hast dich erfolgreich ausgeloggt!";
		return "home";
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









