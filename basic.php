<?php declare(strict_types = 0);

const STOP_NUMBER = 42;

/**
 * Prints numbers from the input stream until the stop number is read.
 *
 * @param resource $stream  Input stream to read from.
 */
function printUntilStopNumber($stream): void {
	while (($line = fgets($stream)) !== false) {
		$line = trim($line);

		if ($line === '') {
			continue;
		}

		$number = (int) $line;

		if ($number == STOP_NUMBER) {
			return;
		}

		echo $number.PHP_EOL;
	}
}

printUntilStopNumber(STDIN);