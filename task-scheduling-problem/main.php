<?php
include_once 'init.php';
include_once 'lib/algorithms.php';

$result = taskSchedulingAlgorithm($numOfTasks, $arrayInput);
$data = implode(' ', $result);

// Write result to file
$distFile = 'dist/output.txt';
$handle = @fopen($distFile, 'w');
fwrite($handle, $data . PHP_EOL);
fclose($handle);
