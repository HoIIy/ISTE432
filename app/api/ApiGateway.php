<?php

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
            if(!empty($_GET["locString"])) {
                $apiQuery = "https://developer.nrel.gov/api/alt-fuel-stations/v1/nearest.json?api_key=tx9yueaUYcSYJn46Jov6S2KaP0F6h2oeWpgaPM9c&format=JSON&location=".$_GET["locString"]."&radius=".$_GET["radius"];
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
        // Echo the data back to the js
        // Once the database is designed, we can call another script to load this data into the DB
        echo $fuelStations;
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