<?
require dirname(__FILE__) . '/ANSIColor.php';
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_CALLBACK, 'bdd_assert');

$ac = new ANSIColor();
$bdd_errors = array();

$bdd_describes = array();
$bdd_its = array();
$bdd_ok = true;
$bdd_tests = 0;
$bdd_tests_failed = 0;

function bdd_assert($file, $line, $code) {
	global $bdd_ok, $bdd_errors, $bdd_describes, $bdd_its;

	$bdd_ok = false;
	$desc = end($bdd_describes);
	$it = end($bdd_its);
	$bdd_errors[] = array('desc' => $desc, 'it' => $it, 'error' =>
		"Assertion Failed:\n  File '$file'\n  Line '$line'\n  Code '$code'");
}


function describe($desc, $fn) {
	global $bdd_describes;

	array_push($bdd_describes, $desc);
	echo bdd_pre_indent($desc, count($bdd_describes)) . "\n";
	$fn();
	array_pop($bdd_describes);
	echo "\n";
}

function it($desc, $fn) {
	global $ac, $bdd_errors, $bdd_describes, $bdd_ok, $bdd_its, $bdd_tests, $bdd_tests_failed;

	$bdd_tests++;

	$describe = end($bdd_describes);

	array_push($bdd_its, $desc);
	try {
		$bdd_ok = true;
		$ret = $fn();
	} catch (Exception $e) {
		echo 'ERR: ' . $e;
	}

	array_pop($bdd_its);

	if (!$bdd_ok) {
		$ret = false;
	}

	if ($ret) {
		echo bdd_pre_indent($ac->green('✓ ') . $ac->white($desc), count($bdd_describes) + 1) . "\n";
	} else {
		$bdd_tests_failed++;

		if ($bdd_ok) {
			$bdd_errors[] = array('desc' => $describe, 'it' => $desc, 'error' => '');
		}

		echo $ac->red('  ' . count($bdd_errors) . ') ' . $desc) . "\n";
	}
}

function bdd_pre_indent($str, $level = 1) {
	return str_repeat('  ', $level) . $str;
}

function bdd_indent($str, $level = 1) {
	return str_repeat('  ', $level) . str_replace("\n", "\n" . str_repeat("  ", $level), $str);
}

function bdd_errors() {
	global $ac, $bdd_errors, $bdd_tests, $bdd_tests_failed;
	echo "\n" . $ac->red('  ✖ ' . $bdd_tests_failed . ' of ' . $bdd_tests . ' failed: ') . "\n\n";

	foreach ($bdd_errors as $n => $err) {
		echo bdd_pre_indent(($n + 1) . ') ' . $err['it'] .  ":\n", 1);
		echo bdd_indent($ac->white($err['error']), 2) . "\n\n";
	}
}
