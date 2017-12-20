<?php

require_once('../views/TemplateEngine.php');
require_once('../models/DB.class.php');
session_start();

class LoginPage {
	
	public function LoginForm(){
		$element = new Template('../views/loginForm.tpl');
		return $element->output();
	}
	
	public function regForm(){
		$element = new Template('../views/regForm.tpl');
		return $element->output();
	}
	
	public function isLoggedIn() {
		if (isset($_SESSION["user"]) && strlen($_SESSION["user"]) > 0) {
			return true;
		}
		return false;
	}
	
	private function sanitizeData($field){
		return $field;
	}
	
	public function loginUser($username, $password){
		if (!isset($username) 
		 || !isset($password)
		 || !strlen($username) > 0
		 || !strlen($password) > 0) {
			 return "Username or password was left blank.";
    	}
		else {
		    $db = new DB();
			if (isset($_SESSION["user"]) && strlen($_SESSION["user"]) > 0) {
				session_destroy();
			}
			
			$username  = strtolower($username);
			$username  = $this->sanitizeData($username);
		    $foundUser = $db->getDataWhere("user", "*", array("username"), array($username));

		    if (isset($foundUser["error"]) || count($foundUser) < 1) {
			    return "Incorrect login.";
		    }
			$foundUser = $foundUser[0];
			if ($foundUser["passwd"] === $password ) {
				// get the user's id and set it as the session
				$userData = $db->getDataWhere("user", "id", array("username"), array($username));
				$userData = $userData[0];
				$userID   = $userData["id"];
				$_SESSION["user"] = $userID;
				
				// get their name to greet them
				$userData  = $db->getDataWhere("user", "fname, lname", array("username"), array($username));
				$userData  = $userData[0];
				$firstName = $userData["fname"];
				$lastName  = $userData["lname"];
				return "Welcome, ".ucfirst($firstName)." ".ucfirst($lastName)."!";
			}
			return "Incorrect login.";
		}
	}
}
?>
