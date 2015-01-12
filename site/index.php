<?php
	// F R O N T   C O N T R O L L E R

	require_once 'autoloader.php';
	$request = new Request();

	$action = $request->getParameter('action', 'home');
	
	// Inizialize model
	if (!DB::create('localhost', 'root', '', 'web_prog')) {
		die("Unable to connect to database [".DB::getInstance()->connect_error."]");
	}
	
	// Init cart
	new Cart();
	
	// Init language
	if(isset($_COOKIE['lang'])){
		new Lang($_COOKIE['lang']);
	}
	else{
		new Lang();
	}
		

		
	try {
		// Create controller
		$controller = new Controller();
		$tpl = $controller->$action($request);
		$tpl = $tpl ? $tpl : $action;
		
		// Create view
		$view = new View($controller);
		$view->render($tpl);
	} catch (Exception $e) {
		die("There was an error processing action '$action'! -> ".$e->getMessage());
	}
