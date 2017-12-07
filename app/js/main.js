var apiDest = "api/ApiGateway.php";
var lastPosition = 0;

$(document).ready(function() {
    // Set all of the map markers
});

function getStations(ele) {
    // Get the form values
    var inputs = $(ele).find('input');
    var selects = $(ele).find('select');
    var values = {"command": "nearest"};

    inputs.each(function(index, element) {
        values[element.name] = encodeURI(element.value);
    });

    selects.each(function(index, element) {
        values[element.name] = $(element).find(":selected").val();
    });

    console.log(values);

    requestData(apiDest, values, function(res) {
        clearAllMarkers();

        // Format the elements in the DOM. TODO figure out how to use Vue.js for this
        $(".listHolder").remove();
        $(".station").remove();
        $("#stationList").append(res);

        var lats = $('.lat');
        var longs = $('.long');

        // In a timeout to allow the map to fully load
        setTimeout(function(){
            for(var j = 0; j < lats.length; j++) {
                createMarker({lat: Number(lats[j].textContent), lng: Number(longs[j].textContent)});
            }

            if(lats.length > 0) {
                map.setCenter(markers[0].getPosition());
            }
        }, 2000);
    });
}

$( ".loginIcon" ).on("click", function(){
	// are we logging in or logging out?
	if ($(this).text().toLowerCase().trim()==="login"){
		getLoginForm();
	}
	else {
		alert("logout");
	}
});

function getLoginForm(){
	$("#map").hide();
	$("#stationList").children().remove();
    $.ajax({
        url: "src/controllers/Login.Controller.php",
        method:"POST",
        data: {"command":"login"}
    }).done(function(data) {
        try {
			// Call the finish function
			data = JSON.parse(data);
			if (typeof data['error'] !== 'undefined') {
				var successRedirect  = "?error=" + encodeURIComponent(data['error']);
				window.location.href = successRedirect;
			}
            $("#stationList").append(data['msg']);
        } catch(e) {
			$("#stationList").append("Error getting data: please refresh or try again.");
        }

    }).fail(function(xhr, status, error) {
        // Handle error
		$("#stationList").append(error);
    });
}

function loginUser(){
	$(".loginIcon").html("<i class=\"w3-xxlarge fa fa-user-circle w3-left\"></i> <span class=\"vCenter\">Logout</span>");
	alert("user has or hasn't been logged in");
	return false;
}

function createAccount(){
	$("#map").hide();
	$("#stationList").children().remove();
    $.ajax({
        url: "src/controllers/Login.Controller.php",
        method:"POST",
        data: {"command":"register"}
    }).done(function(data) {
        try {
			// Call the finish function
			data = JSON.parse(data);
			if (typeof data['error'] !== 'undefined') {
				var successRedirect  = "?error=" + encodeURIComponent(data['error']);
				window.location.href = successRedirect;
			}
            $("#stationList").append(data['msg']);
        } catch(e) {
			$("#stationList").append("Error getting data: please refresh or try again.");
        }

    }).fail(function(xhr, status, error) {
        // Handle error
		$("#stationList").append(error);
    });
}

function regUser(){
    alert("user has or hasn't been registered");
	return false;
}

function forgotPass(){
	alert("Password retrieval currently not implemented.");
}

/**
 * Constructs and sends the ajax request to the API gateway
 * 
 * @param params - Data to pass in the request
 * @param doneFunct - Function to be called when a response is given
 */
function requestData(destination, params, doneFunct) {
    $.ajax({
        url: destination,
        method:"GET",
        data: params
    }).done(function(data) {
        // console.log(data);
        try {
            // response = JSON.parse(data);

            // Call the finish function
            doneFunct(data);
        } catch(e) {
            // Close any modals
            //displayModal(true, false);
            //addNotification(false, 'body', "An error has occurred. Please refresh or try again later")
        }

    }).fail(function(xhr, status, error) {
        // Handle error
        //addNotification(false, 'body', "A network error has occurred. Please refresh or try again later");
        console.log(error);
    });
}