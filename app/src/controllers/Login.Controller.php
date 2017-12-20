<?php

require_once('../models/Login.Model.php');

function buildLoginScreen(){
	$html = '';
	$loginPage = new LoginPage();
	if ($loginPage->isLoggedIn()){
		// are we already logged in? go to the main page and error
		return json_encode(array("error"=>"Please logout before attempting to log in."));
	}
	$html = $loginPage->loginForm();
	return json_encode(array("msg"=>$html));
}

function buildRegScreen(){
	$html = '';
	$loginPage = new LoginPage();
	if ($loginPage->isLoggedIn()){
		// are we already logged in? go to the main page and error
		return json_encode(array("error"=>"Please logout before attempting to log in."));
	}
	$html = $loginPage->regForm();
	return json_encode(array("msg"=>$html));
}

function buildForgotPassScreen(){
	return json_encode(array("msg"=>"forgot pass screen"));
}

function loginAttempt(){
	$html = '';
	$loginPage = new LoginPage();
	if ($loginPage->isLoggedIn()){
		// are we already logged in? go to the main page and error
		return json_encode(array("error"=>"Please logout before attempting to log in."));
	}
	$html = $loginPage->loginUser($_POST["username"], $_POST["psswd"]);
	$loggedIn = $loginPage->isLoggedIn();
	if ($loggedIn) {
		return json_encode(array("msg"=>$html));
	}
	return json_encode(array("error"=>$html));
}

function buildprofileScreen(){
    $html = '';
	$loginPage = new LoginPage();
	$html = $loginPage->profile();
	return json_encode(array("msg"=>$html));
}

function logoutUser(){
    $html = '';
	$loginPage = new LoginPage();
	if (!$loginPage->isLoggedIn()){
		// are we already logged out? go to the main page and error
		return json_encode(array("error"=>"Please login before attempting to logout."));
	}
	try {
		session_destroy();
		$html .= "Bye.";
	}
	catch(Exception $e) {
		return json_encode(array("error"=>"Logout failed."));
	}
	return json_encode(array("msg"=>$html));
}

if(!empty($_POST["command"])) {
	switch($_POST["command"]){
		case 'login':
			echo buildLoginScreen();
			break;
			
		case 'register':
			echo buildRegScreen();
			break;
			
		case 'forgotPass':
			echo buildForgotPassScreen();
			break;
			
		case 'loginAttempt':
		    echo loginAttempt();
			break;
			
		case 'profile':
			echo buildprofileScreen();
			break;
			
		case 'logout':
		    echo logoutUser();
			break;
			
		default:
			return json_encode(array("error"=>"Invalid command."));
			break;
	}
}
else {
	echo 'Invalid request.';
}

?>
