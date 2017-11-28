module.exports = {};

module.exports.initMap = function initMap() {
    // Center of RIT
    var rit = {lat: 43.0861056, lng: -77.672703};

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map("", {
        center: rit,
        zoom: 12
    });
	
	return map;
}