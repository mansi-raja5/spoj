# SPOJ Solutions in PHP

Solutions to SPOJ problems, written in PHP. Each solution reads from standard input and writes to standard output.

## SPOJ Verification

These solutions have been submitted to the SPOJ online judge.

* **SPOJ Username:** mansi_raja
* **Status:** Accepted (AC)
* **Profile Link:** [https://www.spoj.com/users/mansi_raja/](https://www.spoj.com/users/mansi_raja/)

## Problems

| Problem | File | Approach | Time | Space |
| :--- | :--- | :--- | :--- | :--- |
| [TEST](https://www.spoj.com/status/TEST,mansi_raja/) | [basic.php](basic.php) | Read line by line, stop at 42 | O(N) | O(1) |
| [BDL002](https://spoj.com) | [bdl002.php](bdl002.php) | Integer square root, compare two neighbors | O(T) | O(T) |
| [TRT](https://www.spoj.com/status/TRT,mansi_raja/) | [trt.php](trt.php) | Interval DP with a rolling 1D array | O(N²) | O(N) |
| [AGGRCOW](https://www.spoj.com/status/AGGRCOW,mansi_raja/) | [aggrcow.php](aggrcow.php) | Binary search on the answer + greedy check | O(N log N + N log D) | O(N) |
| [NO123ICECREAM](https://www.spoj.com/status/NOI23ICECREAM,mansi_raja/) | [no123icecream.php](no123icecream.php) | Greedy allocation / Simulation logic | O(N) | O(1) |

## Why These Approaches

- **TRT:** Trying every left/right order is O(2^N). The remaining treats are always one contiguous block, so there are only about N²/2 states. A single 1D array keeps memory at O(N) instead of O(N²).
- **AGGRCOW:** Checking every possible distance up to 10⁹ is too slow. If a distance works, every smaller one works too, so binary search finds the answer in about 30 steps, each an O(N) greedy check.
- **NO123ICECREAM:** Processed linearly to optimize state transformations sequentially without storing heavy allocation trees in memory.

## How to Run

```bash
php trt.php < input.txt
```

Example:

```bash
printf "5\n1\n3\n1\n5\n2\n" | php trt.php
```

Output: `43`