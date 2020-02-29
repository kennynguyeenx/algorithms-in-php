<?php
include_once 'lib/array.php';

// Validate input
if (!isset($argv[1]) || $argv[1] < 1) {
    exit('Missing array size or array size is too small');
}

$arraySize = $argv[1];

$numElementsNeedGet = floor($arraySize/3);

// Create array source file
$handle = @fopen('source/array.txt', 'w');
fwrite($handle, $arraySize . '-' . $numElementsNeedGet . PHP_EOL);

// Write matrix
$array = createRandomArray($arraySize);
$arrayString = implode(' ', $array);
fwrite($handle, $arrayString . PHP_EOL);

fclose($handle);
