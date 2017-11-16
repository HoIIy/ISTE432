<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AlternaFuel - Alternative Fuel Station Finder</title>

    <!-- Styles -->
    <link href="styles/style.css" rel="stylesheet">

    <!-- Vue.js (needs to be in the head) -->
    <script type="text/javascript" src="vendor/vue.min.js"></script>
</head>
<body>
    <div id="map"></div>

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1tWKDlFDlo-jIkjlI2yhv2P4QDhBcd3s&callback=initMap" 
    async defer></script>

    <!-- jQuery -->
    <script type="text/javascript" src="vendor/jquery-3.2.1.min.js"></script>

    <!-- JS for handling map -->
    <script type="text/javascript" src="js/MapController.js"></script>

    <!-- Temp for testing API call -->
    <script type="text/javascript">
        $.ajax({
            url: "api/ApiGateway.php",
            method:"POST",
            data: {
                "command": "get stations"
            }
        }).done(function(data) {
           console.log(data);
        });
    </script>
</body>
</html>
