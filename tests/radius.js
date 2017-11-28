module.exports = {};

function setVal(val, defaultVal) {
	return (typeof val == 'undefined') ? defaultVal : val;
}

module.exports.maxRadius = function maxRadius(a) {
	var maxRad = setVal(a, 100);
	return maxRad;
}

module.exports.getRadius = function getRadius(a) {
	var getRad = setVal(a, 50);
	return getRad;
}