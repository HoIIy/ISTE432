var map;

/**
 * Initializes the google map
 */
function initMap() {
    // Center of RIT
    var rit = {lat: 43.186096, lng: -77.6864388};

    // Create a map object and specify the DOM element for display.
    map = new google.maps.Map(document.getElementById('map'), {
        center: rit,
        zoom: 12
    });
}

/**
 * Creates a new marker.
 * TODO: Need to store these in another way
 * 
 * @param pos - lat and long coordinates for marker
 */
function createMarker(pos) {
    var marker = new google.maps.Marker({
        position: pos,
        animation: google.maps.Animation.DROP,
        map: map
    });
}