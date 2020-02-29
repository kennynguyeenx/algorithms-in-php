<?php

$sourceFile = 'source/input.txt';
if (!file_exists($sourceFile)) {
    exit('Missing source file');
}

// Read source file
$data = @file_get_contents($sourceFile);
$data = explode(PHP_EOL, $data);
$numOfTasks = $data[0];
$arrayDeadlines = explode(' ', $data[1]);
$arrayPenalties = explode(' ', $data[2]);
$arrayInput = [];
for ($i = 0; $i < $numOfTasks; $i++) {
    $row = [
        'id' => $i + 1,
        'deadline' => $arrayDeadlines[$i],
        'penalty' => $arrayPenalties[$i]
    ];
    $arrayInput[] = $row;
}
