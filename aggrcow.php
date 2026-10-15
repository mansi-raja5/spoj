<?php declare(strict_types = 0);

/**
 * Checks whether the cows can be placed in the stalls so that every two cows are at least the given distance apart.
 *
 * @param array $stalls    Sorted stall positions.
 * @param int   $cows      Number of cows to place.
 * @param int   $distance  Minimum allowed distance between two cows.
 *
 * @return bool
 */
function canPlaceCows(array $stalls, int $cows, int $distance): bool {
	$stall_count = count($stalls);
	$placed = 1;
	$last_position = $stalls[0];

	for ($i = 1; $i < $stall_count; $i++) {
		if ($stalls[$i] - $last_position >= $distance) {
			$placed++;
			$last_position = $stalls[$i];

			if ($placed >= $cows) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Finds the largest possible minimum distance between any two cows.
 *
 * @param array $stalls  Stall positions in any order.
 * @param int   $cows    Number of cows to place.
 *
 * @return int
 */
function getLargestMinDistance(array $stalls, int $cows): int {
	sort($stalls);

	$low = 1;
	$high = $stalls[count($stalls) - 1] - $stalls[0];
	$best = 0;

	while ($low <= $high) {
		$mid = intdiv($low + $high, 2);

		if (canPlaceCows($stalls, $cows, $mid)) {
			$best = $mid;
			$low = $mid + 1;
		}
		else {
			$high = $mid - 1;
		}
	}

	return $best;
}

$tokens = preg_split('/\s+/', trim(stream_get_contents(STDIN)));
$tests = (int) $tokens[0];
$pos = 1;
$results = [];

for ($i = 0; $i < $tests; $i++) {
	$stall_count = (int) $tokens[$pos];
	$cows = (int) $tokens[$pos + 1];
	$stalls = array_map('intval', array_slice($tokens, $pos + 2, $stall_count));
	$pos += 2 + $stall_count;

	$results[] = getLargestMinDistance($stalls, $cows);
}

echo implode(PHP_EOL, $results).PHP_EOL;