var map;
var markers = [];

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
 */
function createMarker(pos) {
    var marker = new google.maps.Marker({
        position: pos,
        animation: google.maps.Animation.DROP,
        map: map
    });

    markers.push(marker);
}

/**
 * [clearAllMarkers description]
 * @return {[type]} [description]
 */
function clearAllMarkers() {
    var len = markers.length;
    for (var i = 0; i < len; i++ ) {
        markers[i].setMap(null);
    }
    markers = [];
}