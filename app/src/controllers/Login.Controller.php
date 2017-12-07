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

if(!empty($_POST["command"])) {
	echo buildLoginScreen();
}

?>