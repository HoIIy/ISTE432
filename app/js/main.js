// Ajax urls
var apiDest = "src/controllers/ApiGateway.php";
var loginDest = "src/controllers/Login.Controller.php";

var lastPosition = 0; // Keeps track of pagination index
var pageLastDirection; // Keeps track of if 'next' or 'previous' was hit
var currentStations; // List of the most recent search results. Used for pagination
var currentStationsObj = {}; // For accessing individual station elements
var currentStationsLength; // Length of the array of most recent search results
var stationListEle = $("#stationList"); // Container element that holds the list of stations
var PAGE_LENGTH = 5; // Length of stations page

/**
 * Makes a call to get fuel stations based on the search parameters
 * 
 * @param ele - the form element with the search parameters
 */
function getStations(ele) {
    // Get the form values
    var inputs = $(ele).find('input');
    var selects = $(ele).find('select');
    var values = {"command": "nearest"};

    // Get the inputs and selects name/value pairs
    inputs.each(function(index, element) {
        if(element.type == "checkbox") {
            values[element.name] = element.checked;
        }
        else {
            values[element.name] = encodeURI(element.value);
        }
    });

    selects.each(function(index, element) {
        values[element.name] = $(element).find(":selected").val();
    });

    // Trigger the api call
    requestData(apiDest, values, function(res) {
        clearAllMarkers();

        currentStations = $(res);
        currentStationsLength = currentStations.length;

        if(currentStationsLength > 0) {
            // Format the elements in the DOM. TODO figure out how to use Vue.js for this
            $(".listHolder").remove();

            // Add pagination buttons if needed
            if(currentStationsLength > 5 && ($(".pagination").length == 0 || $(".pagination").children().length <= 1)) {
                stationListEle.append(
                    '<div class="w3-bar w3-border w3-round w3-margin-bottom pagination">'+
                       '<button onclick="listStations(0)" class="w3-button paginateL">&#10094; Previous</button>'+
                       '<button onclick="listStations(1)" class="w3-button w3-right paginateR">Next &#10095;</button>'+
                    '</div>'
                );
            }

            // Reset the pagination count
            lastPosition = 0;

            // Create map markers and set stations object
            for(var i = 0; i < currentStationsLength; i++) {
                var ele = $(currentStations[i]);
                var lat = ele.find('.lat').text();
                var long = ele.find('.long').text();
                var id = ele.find('.stationId').text();

                // Set stations object key as the id
                currentStationsObj[id] = currentStations[i];

                // Create info window content
                var infoContent = "<div>"+ele.find('.street').text()+"</div>"+
                        "<button class='w3-button w3-circle w3-teal w3-right' onclick='addToFavorites("+id+")' title='Save to Favorites'>+</button>";

                // Create the map marker
                createMarker({lat: Number(lat), lng: Number(long)}, infoContent, id);
            }

            // List the first page of results
            listStations(1);
        }
        else {
            // Display no results div
        }
    });
}// END getStations

/**
 * Adds the current page of stations to the page. This is also the pagination controller
 * 
 * @param direction - 0 for go back, 1 for go forward
 */
function listStations(direction, reAppendPagination) {

    // Clear the current list of stations
    $(".station").remove();

    if(reAppendPagination) {
        $('.pagination').html(
           '<button onclick="listStations(0)" class="w3-button paginateL">&#10094; Previous</button>'+
           '<button onclick="listStations(1)" class="w3-button w3-right paginateR">Next &#10095;</button>'
        );
    }

    // Reactivate next and last buttons if necessary
    if(direction == 0) {
        $(".paginateR").prop("disabled",false);
    }
    else {
        $(".paginateL").prop("disabled",false);
    }

    // Decrement the last position to get the last page of stations if we are going back a page
    if(direction == 0 && lastPosition != 0) {
        if(pageLastDirection == 0) {
            lastPosition -= PAGE_LENGTH;
        }
        else {
            // IF the last time a page change occurred was a 'next', we need to change where our last position will be 
            // to the lowest number index on the page (the first station listed).
            lastPosition -= PAGE_LENGTH*2;
        }
    }

    // Determine looping length
    var loopLength;
    if(lastPosition+PAGE_LENGTH > currentStationsLength) {
        loopLength = currentStationsLength;
    }
    else {
        loopLength = lastPosition + PAGE_LENGTH;
    }

    // Append this page's stations
    for(var i = lastPosition; i < loopLength; i++) {
        // append the element to the list
        stationListEle.append(currentStations[i]);
    }

    // Center the map on the first marker in the current page
    var id = $(currentStations[lastPosition]).find(".stationId").text();
    map.setCenter(markers[id].marker.getPosition());
    map.setZoom(12);

    // Disable next and previous buttons if necessary
    if(lastPosition == 0) {
        $(".paginateL").prop("disabled",true);
    }
    if(lastPosition+PAGE_LENGTH >= currentStationsLength) {
        $(".paginateR").prop("disabled",true);
    }

    // Increment the last position if we went forward a page
    if(direction == 1) {
        lastPosition += PAGE_LENGTH;
    }
    else {
        // If hitting previous reaches first page, this makes it so that when hitting
        // next, we actually go to the next page as opposed to reprinting the first page again
        if(lastPosition == 0) {
            lastPosition = PAGE_LENGTH;
        }
    }

    // Globally set the direction that we just went
    pageLastDirection = direction;

}// END listStations

/**
 * Displays only one station
 * 
 * @param id - the id of the station to be displayed
 */
function displayClickedStation(id) {
    // Clear the current list of stations
    $('.station').remove();

    // Add selected station
    stationListEle.append(currentStationsObj[id]);

    // Add button to pagination bar to list all of the stations
    var buttonBar = $('.pagination');
    buttonBar.children().remove();
    buttonBar.append('<button onclick="listStations(0, true)" class="w3-button paginateL">List Stations</button>');

    // Reset pagination vars 
    pageLastDirection = 0;
    lastPosition = PAGE_LENGTH;

}//END displayClickedStation

function addToFavorites(id) {
    
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

    requestData(loginDest, {"command":"login"}, function(data) {
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

    });
}

function loginUser(){
	$(".loginIcon").html("<i class=\"w3-xxlarge fa fa-user-circle w3-left\"></i> <span class=\"vCenter\">Logout</span>");
	createProfile();
	alert("user has or hasn't been logged in");
	return false;
}

function createAccount(){
	$("#map").hide();
	$("#stationList").children().remove();

    requestData(loginDest, {"command":"register"}, function(data) {
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

    });
}

function createProfile(){
	$("#map").hide();
	$("#stationList").children().remove();

    requestData(loginDest, {"command":"profile"}, function(data) {
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
 * Constructs and sends the ajax request to the intended destination
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
//console.log(data);
        // Execute the callback function
        doneFunct(data);

    }).fail(function(xhr, status, error) {
        // Handle error
        addNotification(false, 'body', "A network error has occurred. Please refresh or try again later");
        console.log(error);
    });
}

/**
 * Adds a notification to the desired area
 * 
 * @param dismiss - true if we just want to remove the notification
 * @param area - the element where we want to put the notification
 * @param text - what the notification should say
 * @param severity - defines the color of the notification
 */
function addNotification(dismiss, area, text, severity) {
    if(!dismiss) {
        // IF there is already a notification on the screen, get rid of it
        if($(".alert").length > 0) {
            $(".alert").remove();
        }

        var notificationHtml = '<div class="alert '+severity+'">'+
                                 '<span onclick="addNotification(true)" class="closebtn">&times;</span>'+
                                 text+
                               '</div>';

        $(area).prepend(notificationHtml);
    }
    else {
        $(".alert").remove();
    }
}
