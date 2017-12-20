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
	
	public function regUser($fname, $lname, $username, $password) {
		if (!isset($username) 
		 || !isset($password)
		 || !isset($fname)
		 || !isset($lname)
		 || !strlen($username) > 0
		 || !strlen($password) > 0
		 || !strlen($fname) > 0
		 || !strlen($lname) > 0) {
			 return "Username, names, or password were left blank.";
    	}
		else {
		    $db = new DB();
			if (isset($_SESSION["user"]) && strlen($_SESSION["user"]) > 0) {
				session_destroy();
			}
			
			// does this user already exist?
			$username  = strtolower($username);
			$fname     = strtolower($fname);
			$lname     = strtolower($lname);
			$password  = hash('sha256', $password);
		    $foundUser = $db->getDataWhere("user", "*", array("username"), array($username));

		    if ($foundUser["error"] != "Data not found.") {
			    return "Either there was an error or that username is taken. Please pick another.";
		    }
			
			$addUser = $db->insertData("user", 
			                            array("fname", "lname", "username", "passwd"), 
										array($fname, $lname, $username, $password));
			
			if (isset($addUser["msg"])) {
				// login user upon successful registration
				$userData = $db->getDataWhere("user", "*", array("username"), array($username));
				$userData = $userData[0];
				$_SESSION["user"]     = $userData["id"];
				$_SESSION["userName"] = ucfirst($userData["fname"])." ".ucfirst($userData["lname"]);
				return "Welcome, ".$_SESSION["userName"]."!";
			}
			return "Registration failed.";
		}
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
			
			// since we're using prepared statements, let postgres handle sanitization
			$username  = strtolower($username);
			$password  = hash('sha256', $password);
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
				$_SESSION["userName"] = ucfirst($firstName)." ".ucfirst($lastName);
				return "Welcome, ".$_SESSION["userName"]."!";
			}
			return "Incorrect login.";
		}
	}
}
?>
