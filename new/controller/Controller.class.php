<?php 

class Controller {
	
	private $data = array();
	private $sessionState = false;
	private $title;
	
	// A C T I O N S
	
	public function home(Request $request) {
		$this->data["message"] = "Hello World!";
	}
	
	public function bestellung(Request $request) {
		
	}
	
	public function kontakt(Request $request) {
		
	}
	
	public function pralinen(Request $request) {
		$sort = $request->getParameter('sort', 'id');
		$this->data["products"] = Product::getProducts($sort);
		$this->title = "Pralinen List";
	}
	
	public function tafeln(Request $request) {
		
	}
	
	public function warenkorb(Request $request) {
		
	}
	
	public function zubehoer(Request $request) {
		
	}
	
	public function zutaten(Request $request) {
		
	}
	
	public function account(Request $request) {
		
	}
	
	public function login(Request $request) {
		$login = $request->getParameter('login', '');
		$pw = $request->getParameter('pw', '');
		if (!User::checkCredentials($login, $pw)) {
			$this->data['message'] = "Sorry, wrong login/pw!";
			return "account";
		}
		$this->startSession();
		$_SESSION['user'] = $login;
		$this->data['message'] = "You just logged in!";
		return "home";	
		
	}
		
	public function logout(Request $request) {
		$this->startSession();
		session_destroy();
		$_SESSION = [];
		$this->data['message'] = "You just logged out!";
		return "home";
	}
	
	public function list_students(Request $request) {
		$sort = $request->getParameter('sort', 'id');
		$this->data["students"] = Student::getStudents($sort);
		$this->title = "Student List";
	}
	
	public function edit_student(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data['message'] = "To edit a student, you have to login first.";
			return "login";
		}
		$id = $request->getParameter('id', 0);
		$student = Student::getStudentById($id);
		
		if ($student == null) {
			return $this->page404();
		}
		
		$this->data['student'] = $student;
		$this->data['projects'] = Project::getProjects('title');
		
		$this->title = "Edit Student";
	}
	
	public function update_student(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data['message'] = "To update a student, you have to login first.";
			return "login";
		}
		$values = $request->getParameter('student', array());
		
		$student = Student::getStudentById($values['id']);
		if ($student == null) {
			return $this->page404();
		}
		
		$student->update($values);
		$student->save();
		$this->data['message'] = "Student saved!";
		return $this->internalRedirect("list_students", $request);
	}
	
	public function delete_student(Request $request) {
		$this->redirect("home");
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










