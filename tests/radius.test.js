const radius = require('./radius');

test('radius is valid: more than 0 but less than max size', () => {
	expect(radius.getRadius()).toBeLessThanOrEqual(radius.maxRadius());
	expect(radius.getRadius()).toBeGreaterThan(0);
});

