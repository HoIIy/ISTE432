<?php

require_once('../models/Profile.Model.php');

function buildProfileScreen(){
	$html = '';
	$profilePage = new ProfilePage();
	if (!$profilePage->isLoggedIn()){
		// are we not logged in? can't exactly bookmark anything.
		return json_encode(array("error"=>"Please register or login to bookmark stations."));
	}
	$html = $profilePage->profileForm();
	return json_encode(array("msg"=>$html));
}

function addToFavorites(){
	$profilePage = new ProfilePage();
	if (!$profilePage->isLoggedIn()){
		// are we not logged in? we'd have no profile page.
		return json_encode(array("error"=>"Please register or login to bookmark stations."));
	}
	$newStation = (isset($_POST["station"])) ? $_POST["station"] : "";
	$addStation = $profilePage->addToFavorites($newStation);
	return $addStation;
}

if(isset($_POST["command"]) && !empty($_POST["command"])) {
	switch($_POST["command"]){
		case 'viewProfile':
			echo buildProfileScreen();
			break;
			
		case 'addToFavorites':
		    echo addToFavorites();
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
