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

describe('handle exceptions', function() {
	it('should handle throwing exceptions', function() {
		throw new Exception('Blah');
		return true;
	});

	it('should handle math exceptins', function() {
		$x = 42 / 0;
		return true;
	});
});
