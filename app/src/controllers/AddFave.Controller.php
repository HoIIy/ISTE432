<?php

function addFave($station){
    // is it a valid station?
	// get the user
	// add it to their table
	// return success
	return "fave added";
}

if(!empty($_POST["command"])) {
	switch($_POST["command"]){
		case 'addFave':
			echo addFave($_POST["station"]);
			break;
			
		default:
			return json_encode(array("error"=>"Invalid command."));
			break;
	}
}

?>