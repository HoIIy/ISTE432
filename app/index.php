<?php
    require("./src/views/TemplateEngine.php");
    $mainPage = new Template("./src/views/index.tpl");
	
	session_start();
	
	// messages, including errors, are caught and set here
	$errorMsg = "";
	if (isset($_GET["error"])){
		$errorMsg = "<div class='w3-panel w3-red'>";
		$errorMsg .= "<p>Error: ".urldecode($_GET["error"])."</p>";
		$errorMsg .= "</div> ";
	}
	else if (isset($_GET["success"])) {
		$errorMsg = "<div class='w3-panel w3-green'>";
		$errorMsg .= "<p>".urldecode($_GET["success"])."</p>";
		$errorMsg .= "</div> ";
	}
	$mainPage->set("errorMsg", $errorMsg);
	$mainPage->set("mainDomain", "/fuel/");

	// set the navigation based on whether we're currently logged in
	$isLoggedIn = (isset($_SESSION["user"]) && strlen($_SESSION["user"]) > 0) ? true : false;
	$navOne     = ($isLoggedIn) ? "Logout"   : "Login";
	$navTwo     = ($isLoggedIn) ? "Profile"  : "Register";
	$navTwoId   = ($isLoggedIn) ? "profIcon" : "regIcon";
	
	$mainPage->set("nav1", $navOne);
	$mainPage->set("nav2", $navTwo);
	$mainPage->set("nav2Id", $navTwoId);
	
    echo $mainPage->output();
?>

