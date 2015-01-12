<?php 
class User {
	private $id;
	private $name;
	private $pw;
	
	//getters
	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getPw(){
		return $this->pw;
	}
	
	//setters
	public function setName($name){
		$this->name = $name;
	}
	
	//functions
	public static function login($name, $pw) {
		$res = DB::doQuery("SELECT * FROM users WHERE name ='$name'");
		if ($res->num_rows > 0) {
			$user = $res->fetch_object(get_class());
			if(password_verify($pw, $user->getPw())){
				return $user;
			}else {
				return false;
			}
		}
		return FALSE;

	}
	
	public static function create($name, $pw){
		$name = DB::getInstance()->escape_string($name);
		$res = DB::doQuery("SELECT * FROM users WHERE name = '$name'");
		if ($res->num_rows == 0){
			$pw = DB::getInstance()->escape_string($pw);
			$pw = password_hash($pw, PASSWORD_DEFAULT);
			DB::doQuery("INSERT INTO users (name, pw) VALUES ('$name', '$pw')");
			return true;		
		}
		return false;
	}
	
}

