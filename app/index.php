<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AlternaFuel - Alternative Fuel Station Finder</title>

    <!-- Styles -->
    <link href="styles/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Vue.js (needs to be in the head) -->
    <script type="text/javascript" src="vendor/vue.min.js"></script>
</head>
<body class="w3-light-grey">

    <!-- Page Container -->
    <div class="w3-content w3-margin-top" style="max-width:1400px;">

        <div class="w3-container">
            <div class="w3-right loginIcon">
                <a href="#" class="w3-hover-opacity noDecor">
                    <i class="w3-xxlarge fa fa-user-circle w3-left"></i> <span class="vCenter">Login</span>
                </a>
            </div>
            <h1>Alternative Fuel Station Finder</h1>
        </div>

        <!-- The Grid -->
        <div class="w3-row-padding">

        <!-- Left Column -->
        <div class="w3-twothird">

          <!-- Google Map -->
          <div class="w3-container w3-card w3-white w3-margin-bottom">
            <div id="map" class="w3-container"></div>
          </div>
		  
		  <!-- Content -->
          <div class="w3-container w3-card w3-white">
            <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>LIST</h2>
            <div class="w3-container">
              <h5 class="w3-opacity"><b>Station 1</b></h5>
              <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
              <p>Web Development! All I need to know in one place</p>
              <hr>
            </div>
            <div class="w3-container">
              <h5 class="w3-opacity"><b>Station 2</b></h5>
              <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
              <p>Master Degree</p>
              <hr>
            </div>
            <div class="w3-container">
              <h5 class="w3-opacity"><b>Station 3</b></h5>
              <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
              <p>Bachelor Degree</p><br>
            </div>
          </div>

        <!-- End Left Column -->
        </div>

        <!-- Right Column -->
        <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">
                <!-- Search filters -->
                <form class="w3-container">

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-compass"></i></div>
                        <div class="w3-rest">
                          <input class="w3-input w3-border" name="location" type="text" placeholder="address, ZIP, or state...">
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-flash"></i></div>
                        <div class="w3-rest">
                            <select class="w3-select" name="fuel">
                              <option value="all">All Fuels</option>
                              <option value="BD">Biodiesel (B20 and above)</option>
                              <option value="CNG">Compressed Natural Gas</option>
                              <option value="ELEC">Electric</option>
                              <option value="E85">Ethanol (E85)</option>
                              <option value="HY">Hydrogen</option>
                              <option value="LPG">Liquefied Petroleum Gas (Propane)</option>
                              <option value="LNG">Liquefied Natural Gas (LNG)</option>
                            </select> 
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                        <div class="w3-rest">
                          <select class="w3-select" name="owner">
                              <option value="all" selected="selected">All Owner Types</option>
                              <option value="P">Private</option>
                              <option value="FG">Federal</option>
                              <option value="SG">State</option>
                              <option value="LG">Local</option>
                              <option value="T">Utility</option>
                            </select> 
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-dollar"></i></div>
                        <div class="w3-rest">
                          <select class="w3-select" name="payment">
                              <option value="all" selected="selected">All Payment Types</option>
                              <option value="A">American Express</option>
                              <option value="Debit">Debit</option>
                              <option value="D">Discover</option>
                              <option value="M">MasterCard</option>
                              <option value="V">Visa</option>
                              <option value="Cash">Cash</option>
                              <option value="Checks">Check</option>
                              <option value="CleanEnergy">Clean Energy</option>
                              <option value="Comdata">Comdata</option>
                              <option value="CFN">Commercial Fueling Network</option>
                              <option value="EFS">EFS</option>
                              <option value="FleetOne">Fleet One</option>
                              <option value="FuelMan">Fuelman</option>
                              <option value="GasCard">GASCARD</option>
                              <option value="PacificPride">Pacific Pride</option>
                              <option value="PHH">PHH</option>
                              <option value="Proprietor">Proprietor Fleet Card</option>
                              <option value="Speedway">Speedway</option>
                              <option value="TCH">TCH</option>
                              <option value="Tchek">T-Chek T-Card</option>
                              <option value="Trillium">Trillium</option>
                              <option value="Voyager">Voyager</option>
                              <option value="Wright_Exp">WEX</option>
                            </select> 
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-location-arrow"></i></div>
                        <div class="w3-rest">
                          <label>Distance in miles</label>
                          <input class="w3-input w3-border" name="distance" type="number" value="5">
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-ban"></i></div>
                        <div class="w3-rest">
                            <input class="w3-check" name="private" type="checkbox">
                            <label>Include Private Stations</label>
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-warning"></i></div>
                        <div class="w3-rest">
                            <input class="w3-check" name="planned" type="checkbox">
                            <label>Include Planned Stations</label>
                        </div>
                    </div>

                    <button class="w3-button w3-block w3-section w3-teal w3-ripple w3-padding">Search</button>

                </form>
            </div>

        <!-- End Right Column -->
        </div>

        <!-- End Grid -->
        </div>
          
    <!-- End Page Container -->
    </div>

    <footer class="w3-container w3-teal w3-center w3-margin-top">
      <p>
        Fuel station data sourced from 
        <a href="https://developer.nrel.gov/docs/transportation/alt-fuel-stations-v1/" target="_blank" class="w3-hover-opacity">
            National Renewable Energy Laboratory
        </a>
      </p>
      <p>
        Powered by 
        <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-opacity">
            w3.css
        </a> and
        <a href="https://vuejs.org/" target="_blank" class="w3-hover-opacity">Vue.js</a>
      </p>
    </footer>

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
            method:"GET",
            data: {
                "command": "get stations"
            }
        }).done(function(data) {
           console.log(data);
        });
    </script>
</body>
</html>
