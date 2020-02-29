<?php
include_once 'helper.php';

/**
 * @param array $array
 * @param int $p
 * @param int $r
 * @return int
 */
function partition(array &$array, int $p , int $r): int
{
    $x = $array[$r];
    $i = $p - 1;
    for ($j = $p; $j <= $r - 1; $j++) {
        if ($array[$j] <= $x) {
            exchange($array[++$i], $array[$j]);
        }
    }
    exchange($array[++$i], $array[$r]);
    return $i;
}

/**
 * @param array $array
 * @param int $p
 * @param int $r
 * @return int
 */
function randomizedPartition(array &$array, int $p, int $r): int
{
    $index = rand($p, $r);
    exchange($array[$r], $array[$index]);
    return partition($array, $p, $r);
}

/**
 * @param array $array
 * @param int $p
 * @param int $r
 * @param int $pivot
 * @return int
 */
function partitionWithPivot(array &$array, int $p, int $r, int $pivot): int
{
    for ($i = $p; $i <= $r; $i++) {
        if ($array[$i] == $pivot) {
            exchange($array[$r], $array[$i]);
            break;
        }
    }

    return partition($array, $p, $r);
}
