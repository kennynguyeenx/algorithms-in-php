<?php
include_once 'lib/array.php';
include_once 'lib/select.php';

$sourceFile = 'source/array.txt';
if (!file_exists($sourceFile)) {
    exit('Missing source file');
}

// Read source file
$data = @file_get_contents($sourceFile);
$data = explode(PHP_EOL, $data);

$arrayInfo = explode('-', $data[0]);
$arraySize = $arrayInfo[0];
$numElementsNeedGet = $arrayInfo[1];
$array = explode(' ', $data[1]);
