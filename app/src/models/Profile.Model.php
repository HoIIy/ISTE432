<?php

require_once('../views/TemplateEngine.php');
require_once('../models/DB.class.php');
session_start();

class ProfilePage {
	
	private $fuelTypes = array(
        'BD' => 'Biodiesel',
        'CNG' => 'Compressed Natural Gas',
        'E85' => 'Ethanol',
        'ELEC' => 'Electric',
        'HY' => 'Hydrogen',
        'LNG' => 'Liquefied Natural Gas',
        'LPG' => 'Liquefied Petroleum Gas'
    );
	
	// adds a given station to favorites.
	// precondition: we're logged in; the controller already checked.
	public function addToFavorites($station) {
		$db        = new DB();
		$userID    = $_SESSION["user"];
		$username  = strtolower($username);
		
		// did we already favorite this station?
		$foundStation = $db->getDataWhere("user_stations", "*", array("user_id", "station_id"), array($userID, $station));
		if (isset($foundStation["error"]) || count($foundStation) <= 0) {
			$addStation = $db->insertData("user_stations", 
			                              array("user_id", "station_id", "is_hidden", "is_favorite"), 
										  array($_SESSION["user"], $station, "f", "t"));
										  
			if (isset($addStation["msg"])) {
				return json_encode("Station #".$station." was added to favorites.");
			}
		}
		else {
			return json_encode("Station ".$station." is already in your favorites.");
		}
	}
	
	// retrieves the favorite stations for the current user
	private function getStations(){
		$db           = new DB();
		$userID       = $_SESSION["user"];
		$userStations = $db->getDataWhere("user_stations", "station_id", array("user_id"), array($userID));
		$faveStations = "";
		
		foreach ($userStations as $userStation) {
			$apiQuery = "https://developer.nrel.gov/api/alt-fuel-stations/v1/".$userStation["station_id"].
			".json?api_key=tx9yueaUYcSYJn46Jov6S2KaP0F6h2oeWpgaPM9c&format=JSON";
			
			$thisStation = json_decode(file_get_contents($apiQuery), true);
			$thisStation = $thisStation["alt_fuel_station"];
			
			$newStation = new Template("../views/stationCard.tpl");
			$newStation->set("street",     $thisStation["street_address"]);
			$newStation->set("access",     $thisStation["access_days_time"]);
			$newStation->set("fuel",       $thisStation["access_days_time"]);
			$newStation->set("group",      $thisStation["groups_with_access_code"]);
			$newStation->set("phone",      $thisStation["station_phone"]);
			$newStation->set("types",      $this->fuelTypes[$thisStation["fuel_type_code"]]);
			$newStation->set("directions", $thisStation["intersection_directions"]);
			$newStation->set("lat",        $thisStation["latitude"]);
			$newStation->set("long",       $thisStation["longitude"]);
			$newStation->set("id",         $thisStation["id"]);
			
			$faveStations .= $newStation->output();
		}
		return $faveStations;
	}
	
	// builds the user's profile view
	public function ProfileForm(){
		$element = new Template('../views/profileForm.tpl');
		$element->set("username", $_SESSION["userName"]);
		$element->set("userStations", $this->getStations());
		return $element->output();
	}
	
	// are we logged in?
	public function isLoggedIn() {
		if (isset($_SESSION["user"]) && strlen($_SESSION["user"]) > 0) {
			return true;
		}
		return false;
	}
}
?>
