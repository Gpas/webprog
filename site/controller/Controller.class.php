<?php 

class Controller {
	
	private $data = array();
	private $sessionState = true;
	private $title;
	
	// A C T I O N S
	
	public function home(Request $request) {
		$this->data["message"] = "<h1>Willkommen im Schoggi Shop</h1>
		<p>
		Hier kannst du all deine Schoggi Wünsche erfüllen! 
		Und das ganze ohne Versandkosten und extra schneller Lieferung.
		</p>";
	}
	
	public function bestellung(Request $request) {
		
	}
	
	public function kontakt(Request $request) {
		
	}
	
	public function pralinen(Request $request) {
		$sort = $request->getParameter('sort', 'id');
		$this->data["products"] = Product::getProductsbyCat('pralines', $sort);
		$this->title = "Pralinen";
	}
	
	public function tafeln(Request $request) {
		
	}
	
	public function produktansicht(Request $request) {
		$id = $request->getParameter('produkt_id', '0');
		$this->data["product"] = Product::getProductbyId($id);
		$this->title = $this->data["product"]->getName();
	}
	
	public function warenkorb(Request $request) {
		
	}
	
	public function zubehoer(Request $request) {
		
	}
	
	public function zutaten(Request $request) {
		
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
		session_destroy();
		$_SESSION = [];
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

<script>
	function addProduct(){
		
	}
</script>







