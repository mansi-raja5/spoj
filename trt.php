<?php declare(strict_types = 0);

/**
 * Calculates the maximum revenue from selling treats, one per day, from either end of the box.
 *
 * @param array $values  Values of the treats in the order they are stored.
 *
 * @return int
 */
function getMaxRevenue(array $values): int {
	$count = count($values);
	$revenue = array_fill(0, $count + 1, 0);

	for ($length = 1; $length <= $count; $length++) {
		// The treat sold from an interval of this length is sold on the day equal to this age.
		$age = $count - $length + 1;
		$last_start = $count - $length;

		for ($start = 0; $start <= $last_start; $start++) {
			$end = $start + $length - 1;

			$sell_left = $values[$start] * $age + $revenue[$start + 1];
			$sell_right = $values[$end] * $age + $revenue[$start];

			$revenue[$start] = max($sell_left, $sell_right);
		}
	}

	return $revenue[0];
}

$tokens = preg_split('/\s+/', trim(stream_get_contents(STDIN)));
$count = (int) $tokens[0];
$values = array_map('intval', array_slice($tokens, 1, $count));

echo getMaxRevenue($values).PHP_EOL;