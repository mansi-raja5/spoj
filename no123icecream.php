<?php declare(strict_types = 0);

/**
 * Reads the next whitespace separated integer from the input that is being tokenized.
 *
 * @return int
 */
function readInt(): int {
	return (int) strtok(" \t\r\n");
}

/**
 * Calculates the minimum number of cleanings needed to serve the whole queue.
 *
 * @param array $flavours       Flavours in queue order.
 * @param int   $flavour_count  Number of different flavours offered.
 * @param int   $machines       Number of ice cream machines.
 *
 * @return int
 */
function getMinCleanings(array $flavours, int $flavour_count, int $machines): int {
	$count = count($flavours);
	$next_use = array_fill(0, $count, $count);
	$last_seen = [];

	for ($i = $count - 1; $i >= 0; $i--) {
		$flavour = $flavours[$i];

		if (array_key_exists($flavour, $last_seen)) {
			$next_use[$i] = $last_seen[$flavour];
		}

		$last_seen[$flavour] = $i;
	}

	// With enough machines every flavour is loaded exactly once.
	if (count($last_seen) <= $machines) {
		return count($last_seen);
	}

	$base = $flavour_count + 1;
	$loaded = [];
	$loaded_count = 0;
	$cleanings = 0;
	$heap = new SplMaxHeap();

	for ($i = 0; $i < $count; $i++) {
		$flavour = $flavours[$i];

		if (!array_key_exists($flavour, $loaded)) {
			$cleanings++;

			if ($loaded_count == $machines) {
				// Clean the machine whose flavour is needed again the latest. Outdated heap entries are skipped.
				do {
					$top = $heap->extract();
					$evict = $top % $base;
					$evict_next_use = intdiv($top, $base);
				}
				while (!array_key_exists($evict, $loaded) || $loaded[$evict] != $evict_next_use);

				unset($loaded[$evict]);
				$loaded_count--;
			}

			$loaded_count++;
		}

		$loaded[$flavour] = $next_use[$i];
		$heap->insert($next_use[$i] * $base + $flavour);
	}

	return $cleanings;
}

$input = stream_get_contents(STDIN);
$tests = (int) strtok($input, " \t\r\n");
$results = [];

for ($test = 0; $test < $tests; $test++) {
	$customers = readInt();
	$flavour_count = readInt();
	$machines = readInt();
	$flavours = [];

	for ($i = 0; $i < $customers; $i++) {
		$flavours[] = readInt();
	}

	$results[] = getMinCleanings($flavours, $flavour_count, $machines);
}

echo implode(PHP_EOL, $results).PHP_EOL;