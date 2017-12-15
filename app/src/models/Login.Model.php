<?php

require_once('../views/TemplateEngine.php');

class LoginPage {
	public function isLoggedIn(){
		if (isset($_SESSION['user'])) {
			return true;
		}
		return false;
	}
	
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
}
?>
