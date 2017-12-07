<?php

require_once("../src/controllers/Controller.php");

if(!empty($_GET["command"]))
{
    $apiQuery = "";

    switch ($_GET["command"]) {
        case "stations":
            // Grab data from the API and parse it into an assoc array
            $apiQuery = "https://developer.nrel.gov/api/alt-fuel-stations/v1.json?api_key=tx9yueaUYcSYJn46Jov6S2KaP0F6h2oeWpgaPM9c&format=JSON&status=E&state=NY";

            break;

        case "nearest":
            // Location string
            if(!empty($_GET["location"])) {
                $apiQuery = "https://developer.nrel.gov/api/alt-fuel-stations/v1/nearest.json?api_key=tx9yueaUYcSYJn46Jov6S2KaP0F6h2oeWpgaPM9c&format=JSON&location=".$_GET["location"]."&radius=".$_GET["distance"]."&limit=5"."&fuel_type=".$_GET["fuel"]."&owner_type=".$_GET["owner"]."&cards_accepted=".$_GET['payment'];
            }
            // Or latitude/longitude
            else if(!empty($_GET["lat"]) && !empty($_GET["long"])) {
                $apiQuery = "https://developer.nrel.gov/api/alt-fuel-stations/v1/nearest.json?api_key=tx9yueaUYcSYJn46Jov6S2KaP0F6h2oeWpgaPM9c&format=JSON&latitude=".$_GET["lat"]."&longitude=".$_GET["long"]."&radius=".$_GET["radius"];
            }
            else {
                $apiQuery = "error";
            }

            break;
        default:
            // Echo no command given error
            break;
    }

    // Get the data from the API
    if($apiQuery != "error") {
        $fuelStations = callApi($apiQuery);
    }
    else {
        $fuelStations = $apiQuery;
    }

    // Determine what to echo back to script
    if($fuelStations == "error")
    {
        // Echo error
        echo "Error";
        die;
    }
    else
    {
        $output;

        if($_GET["command"] == "nearest") {
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
        return "error";
    }
    else {
        return json_encode($data);
    }
}
?>