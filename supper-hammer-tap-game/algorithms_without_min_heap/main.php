<?php
include_once 'init.php';
include_once 'lib/algorithm.php';

$result = algorithm($arrayTimeAppear, $arrayAnimalsHeight);
$sequenceTap = implode(' ', $result['arrayTap']);

// Write result to file
$distFile = 'dist/output.txt';
$handle = @fopen($distFile, 'w');
fwrite($handle, $result['sumDisappearTime'] . PHP_EOL);
fwrite($handle, $sequenceTap . PHP_EOL);
fclose($handle);
