<?php
include_once 'matrix.php';
include_once 'simple_algorithm.php';
include_once 'strassen_algorithm.php';

$sourceFile = 'source/matrix.txt';
if (!file_exists($sourceFile)) {
    exit('Missing source file');
}

// Read source file
$data = @file_get_contents($sourceFile);
$arrayData = explode(PHP_EOL, $data);

$matrixSize = $arrayData[0];
$tempMatrixA = array_slice($arrayData, 1, $matrixSize);
$tempMatrixB = array_slice($arrayData, $matrixSize + 1, $matrixSize);

// Create 2 matrix
$matrixA = readMatrix($matrixSize, $tempMatrixA);
$matrixB = readMatrix($matrixSize, $tempMatrixB);

// Simple algorithm
$startTime = round(microtime(true) * 1000);
$productMatrix = multipleMatrixBySimpleAlgorithm($matrixSize, $matrixA, $matrixB);
$endTime = round(microtime(true) * 1000);
$execTime = $endTime - $startTime;

// Write result to file
$distFile = 'dist/simple.txt';
$handle = @fopen($distFile, 'w');
fwrite($handle, $execTime . ' ms' . PHP_EOL);
writeMatrix($handle, $matrixSize, $productMatrix);
fclose($handle);

// Strassen algorithm
$startTime = round(microtime(true) * 1000);
$productMatrix = multipleMatrixByStrassenAlgorithm($matrixSize, $matrixA, $matrixB);
$endTime = round(microtime(true) * 1000);
$execTime = $endTime - $startTime;

// Write result to file
$distFile = 'dist/strassen.txt';
$handle = @fopen($distFile, 'w');
fwrite($handle, $execTime . ' ms' . PHP_EOL);
writeMatrix($handle, $matrixSize, $productMatrix);
fclose($handle);
