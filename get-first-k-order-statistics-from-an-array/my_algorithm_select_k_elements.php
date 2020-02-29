<?php
include_once 'init.php';

// Select first k order statistics from an array by using my algorithm
$startTime = round(microtime(true) * 1000);
$result = myAlgorithmSelectKElements($array, $numElementsNeedGet);
$endTime = round(microtime(true) * 1000);
$execTime = $endTime - $startTime;

// Write result to file
$distFile = 'dist/my_algorithm_select_k_elements.txt';
$handle = @fopen($distFile, 'w');
fwrite($handle, $execTime . ' ms' . PHP_EOL);
fwrite($handle, implode(' ', $result) . PHP_EOL);
fclose($handle);
