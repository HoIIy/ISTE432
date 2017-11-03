<?php

if(isset($_POST))
{
    switch ($_POST['command'])
    {
        case 'get stations':
            // Grab data from the API and parse it into an assoc array
            $fuelStations = json_decode(file_get_contents("https://developer.nrel.gov/api/alt-fuel-stations/v1.json?api_key=tx9yueaUYcSYJn46Jov6S2KaP0F6h2oeWpgaPM9c&format=JSON&status=E&state=NY"), true);

            if(isset($fuelStations['error']))
            {
                // Echo error
                echo "Error";
                die;
            }
            else
            {
                // Echo the data back to the js
                // Once the database is designed, we can call another script to load this data into the DB
                echo var_dump($fuelStations);
                die;
            }
            break;
        
        default:
            // Echo no command given error
            break;
    }
}
?>