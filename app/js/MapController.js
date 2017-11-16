var map;
function initMap() {
    // Center of RIT
    var rit = {lat: 43.0861056, lng: -77.672703};

    // Create a map object and specify the DOM element for display.
    map = new google.maps.Map(document.getElementById('map'), {
        center: rit,
        zoom: 12
    });

    // Add marker
    // This can be done progmatically very easily with the data returned from the fuel API
    var marker = new google.maps.Marker({
        position: rit,
        animation: google.maps.Animation.DROP,
        map: map
    });

}