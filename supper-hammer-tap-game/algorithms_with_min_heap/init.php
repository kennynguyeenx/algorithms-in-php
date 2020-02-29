<?php

$sourceFile = 'source/input.txt';
if (!file_exists($sourceFile)) {
    exit('Missing source file');
}

// Read source file
$data = @file_get_contents($sourceFile);
$data = explode(PHP_EOL, $data);

$numAnimals = $data[0];
$arrayTimeAppear = explode(' ', trim($data[1]));
$arrayAnimalsHeight = explode(' ', trim($data[2]));
$data = [];
foreach ($arrayTimeAppear as $index => $value) {
    $temp = [
        'id' => $index + 1,
        'timeAppear' => $value,
        'timeToLive' => $arrayAnimalsHeight[$index]
    ];
    $data[$index + 1] = $temp;
}
