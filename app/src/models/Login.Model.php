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
	
	public function profile(){
        $element = new Template('../views/profile.tpl');
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
		    if (!isset($foundUser) || count($foundUser) <= 0) {
			    return "Incorrect login.";
		    }
			if ($foundUser["passwd"] === $password ) {
				$_SESSION["user"] = ucfirst($username);
				return "Welcome, ".$_SESSION["user"]."!";
			}
			return "Incorrect login.";
		}
	}
}
?>
