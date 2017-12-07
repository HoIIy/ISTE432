var apiDest = "api/ApiGateway.php";
var lastPosition = 0;

$(document).ready(function() {
    requestData(apiDest, {
        "command": "nearest",
        "locString": "rochester,ny",
        "radius": 5
    }, function(res) {
        console.log(res);
        $(".listHolder").remove();
        $("#stationList").append(res);
    });
});

// $.ajax({
//     url: "api/ApiGateway.php",
//     method:"GET",
//     data: {
//         "command": "nearest",
//         "locString": "rochester,ny",
//         "radius": 5
//     }
// }).done(function(data) {
//    console.log(data);
// });

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
    });
}