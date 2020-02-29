<?php
include_once 'lib/array.php';

$sourceFile = 'source/input.txt';
if (!file_exists($sourceFile)) {
    exit('Missing source file');
}

// Read source file
$data = @file_get_contents($sourceFile);
$data = explode(PHP_EOL, $data);

$numAnimals = $data[0];
$arrayTimeAppear = convertArrayStartFromOne(explode(' ', $data[1]));
$arrayAnimalsHeight = convertArrayStartFromOne(explode(' ', $data[2]));
