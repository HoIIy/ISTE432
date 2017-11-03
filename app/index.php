<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AlternaFuel - Alternative Fuel Station Finder</title>

    <!-- Styles -->
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>



    <!-- JS -->

    <!-- jQuery (may not need this with Vue) -->
    <script type="text/javascript" src="vendor/jquery-3.2.1.min.js"></script>

    <!-- Vue.js -->
    <script type="text/javascript" src="vendor/vue.min.js"></script>

    <!-- Temp for testing API call -->
    <script type="text/javascript">
        $.ajax({
            url: "api/ApiGateway.php",
            method:"POST",
            data: {
                "command": "get stations"
            }
        }).done(function(data) {
            $('body').html(data);
        });
    </script>
</body>
</html>