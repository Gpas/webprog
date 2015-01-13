<?php
	// A J A X  C O N T R O L L E R

	require_once 'autoloader.php';
	$request = new Request();

	$action = $request->getParameter('action', 'home');
	
	// Inizialize model
	if (!DB::create('localhost', 'root', '', 'web_prog')) {
		die("Unable to connect to database [".DB::getInstance()->connect_error."]");
	}
		
	try {
		// Create controller
		$controller = new AjaxController();
		$controller->$action($request);

	} catch (Exception $e) {
		die("There was an error processing action '$action'! -> ".$e->getMessage());
	}
