var map;
var markers = {}; // object of current markers
var lastOpenedWindow = '';

/**
 * Initializes the google map
 */
function initMap() {
    // Create a map object and specify the DOM element for display.
    // Initially centered on the geographic center of the US
    // Lebanon, KS, probably the most boring place on earth
    map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(39.8097343, -98.5556199),
        zoom: 4
    });
}

/**
 * Creates a new marker.
 * 
 * @param pos - lat and long coordinates for marker
 * @param content - content for the marker's info window
 * @param id - the id of the corresponding station element
 */
function createMarker(pos, content, id) {
    var marker = new google.maps.Marker({
        position: pos,
        animation: google.maps.Animation.DROP,
        map: map
    });

    // Create the info window for this marker
    var infowindow = new google.maps.InfoWindow({
        content: content
    });

    marker.addListener('click', function() {
        openInfoWindow(infowindow, marker);

        // Set the stations list to the station that was clicked
        displayClickedStation(id);
    });

    markers[id] = {marker:marker,infowindow:infowindow};
}

/**
 * When a station list element is clicked, this will center on the 
 * corresponding marker and open it's info window
 * 
 * @param id - the station/marker id
 */
function highlightMarker(id) {
    map.setCenter(markers[id].marker.getPosition());
    map.setZoom(12);
    openInfoWindow(markers[id].infowindow, markers[id].marker);
}

/**
 * Opens a marker's info window and removes the last info window that was opened
 * 
 * @param infoWindow - the marker's info window
 * @param marker - the specific marker on the map
 */
function openInfoWindow(infoWindow, marker) {
    if(lastOpenedWindow != '') {
        lastOpenedWindow.close();
    }

    infoWindow.open(map, marker);

    lastOpenedWindow = infoWindow;

    // Scroll the map into view
    document.getElementById('map').scrollIntoView();
}

/**
 * Clears all of the markers from the map and resets the markers object
 */
function clearAllMarkers() {
    if(lastOpenedWindow != "") {
        lastOpenedWindow.close();
    }

    var len = markers.length;
    for (var i in markers) {
        markers[i].marker.setMap(null);
    }
    markers = {};
}