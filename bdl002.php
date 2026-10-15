<?php declare(strict_types = 0);

/**
 * Calculates the integer square root, which is the largest integer whose square does not exceed the number.
 *
 * @param int $number  Non-negative integer.
 *
 * @return int
 */
function getIntegerSquareRoot(int $number): int {
	$root = (int) sqrt($number);

	// Correct possible floating point rounding errors.
	while ($root * $root > $number) {
		$root--;
	}

	while (($root + 1) * ($root + 1) <= $number) {
		$root++;
	}

	return $root;
}

/**
 * Finds the square number closest to the given number.
 *
 * @param int $number  Positive integer.
 *
 * @return int
 */
function getClosestSquare(int $number): int {
	$root = getIntegerSquareRoot($number);
	$lower = $root * $root;
	$upper = ($root + 1) * ($root + 1);

	return $number - $lower <= $upper - $number ? $lower : $upper;
}

$tokens = preg_split('/\s+/', trim(stream_get_contents(STDIN)));
$tests = (int) $tokens[0];
$results = [];

for ($i = 1; $i <= $tests; $i++) {
	$results[] = getClosestSquare((int) $tokens[$i]);
}

echo implode(PHP_EOL, $results).PHP_EOL;