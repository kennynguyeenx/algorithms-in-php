<?php
include_once 'matrix.php';

$matrixSize = $argv[1];

// Validate input
if (!isset($matrixSize)) {
    exit('Missing matrix size');
}

// Create matrix source file
$handle = @fopen('source/matrix.txt', 'w');
fwrite($handle, $matrixSize . PHP_EOL);

// Write matrix
$matrixA = createRandomMatrix($matrixSize);
$matrixB = createRandomMatrix($matrixSize);

foreach ($matrixA as $row) {
    fwrite($handle, $row . PHP_EOL);
}

foreach ($matrixB as $row) {
    fwrite($handle, $row . PHP_EOL);
}

fclose($handle);
