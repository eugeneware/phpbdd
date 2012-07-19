<?
describe('my first bdd test', function() {
	it('should run this code', function() {
		return true;
	});

	it('should run this code too', function() {
		return true;
	});
});

describe('check results of functions', function() {
	it('should fail', function() {
		assert(false);
		return false;
	});

	it('should pass', function() {
		return true;
	});
});
