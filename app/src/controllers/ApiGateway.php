<?php

require_once("Controller.php");

if(!empty($_GET["command"]))
{
    $apiQuery = "";

    switch ($_GET["command"]) {
        case "stations":
            // Grab data from the API and parse it into an assoc array
            $apiQuery = "https://developer.nrel.gov/api/alt-fuel-stations/v1.json?api_key=tx9yueaUYcSYJn46Jov6S2KaP0F6h2oeWpgaPM9c&format=JSON&status=E&state=NY";
            break;

        case "nearest":
            // Build API query string
            if(!empty($_GET["location"]) || 
              (!empty($_GET["lat"]) && !empty($_GET["long"]))) {

                if(!empty($_GET["location"])) {
                    $apiQuery = "https://developer.nrel.gov/api/alt-fuel-stations/v1/nearest.json?".
                        "api_key=tx9yueaUYcSYJn46Jov6S2KaP0F6h2oeWpgaPM9c&format=JSON".
                        "&location=".$_GET["location"];
                }
                else {
                    $apiQuery = "https://developer.nrel.gov/api/alt-fuel-stations/v1/nearest.json?".
                        "api_key=tx9yueaUYcSYJn46Jov6S2KaP0F6h2oeWpgaPM9c&format=JSON".
                        "&latitude=".$_GET["lat"].
                        "&longitude=".$_GET["long"];
                }

                // Add general parameters
                $apiQuery .= "&radius=5".
                             "&fuel_type=".$_GET["fuel"].
                             "&owner_type=".$_GET["owner"].
                             "&cards_accepted=".$_GET['payment'];

                // Determine if planned stations should be excluded
                if("false" == $_GET["private"]) {
                    $apiQuery .= "&status=E";
                }

                // Determine if private stations should be excluded
                if("false" == $_GET["planned"]) {
                    $apiQuery .= "&access=public";
                }
            }
            else {
                $apiQuery = array("error" => "No location set!");
            }

            break;
        default:
            // Echo no command given error
            break;
    }

    // Get the data from the API
    if(!isset($apiQuery["error"])) {
        $fuelStations = callApi($apiQuery);
    }
    else {
        $fuelStations = $apiQuery;
    }

    // Determine what to echo back to script
    if(isset($fuelStations["error"]))
    {
        // Echo the error
        echo "{'error':'An error occurred. Please refresh or try again.','log':'API error - ".$fuelStations["error"]."'}";
        die;
    }
    else
    {
        if($_GET["command"] == "nearest") {
            // Called from Controller.php
            $output = buildStationList(json_decode($fuelStations, true)['fuel_stations']);
        }
        else {
            $output = $fuelStations;
        }

        // Echo the data back to the js
        echo $output;
        die;
    }
}

function callApi($queryString) {
    $data = json_decode(file_get_contents($queryString), true);

    if(isset($data["error"])) {
        return $data;
    }
    else {
        return json_encode($data);
    }
}
?>
