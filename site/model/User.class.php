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
	
	//setters
	public function setName($name){
		$this->name = $name;
	}
	
	//functions
	public static function login($name, $pw) {
		$res = DB::doQuery("SELECT * FROM users WHERE name ='$name' AND pw = '$pw' ");
		if ($res) {
			$user = $res->fetch_object(get_class());
			return $user;
		}
		return FALSE;

	}
	
}

