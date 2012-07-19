# PHPBDD

A simple BDD library for PHP

# Examples

Put your tests in the 'tests' directory:

```php
<? // in ./tests/mytest.php
describe('my first bdd test', function() {
	it('should run this code', function() {
		return true;
	});

	it('should run this code too', function() {
		return true;
	});
});
```

Then run your tests by running the 'phpbdd' command:

```
phpbdd
```

And then you should get a pretty formatted set of test results.
