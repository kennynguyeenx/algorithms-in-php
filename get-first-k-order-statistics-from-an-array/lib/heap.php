<?php
include_once 'helper.php';

/**
 * @param array $array
 * @param int $heapSize
 * @param int $i
 */
function minHeapify(array &$array, int $heapSize, int $i)
{
    $left = left($i);
    $right = right($i);

    if ($left <= $heapSize && $array[$left] < $array[$i]) {
        $smallest = $left;
    } else {
        $smallest = $i;
    }

    if ($right <= $heapSize && $array[$right] < $array[$smallest]) {
        $smallest = $right;
    }

    if ($smallest != $i) {
        exchange($array[$i], $array[$smallest]);
        minHeapify($array, $heapSize, $smallest);
    }
}

/**
 * @param $array
 */
function buildMinHeap(&$array)
{
    $heapSize = count($array);
    $numLoop = floor($heapSize/2);
    for ($i = $numLoop; $i >= 1; $i--) {
        minHeapify($array, $heapSize, $i);
    }
}

/**
 * @param array $array
 * @param int $heapSize
 * @param int $i
 */
function maxHeapify(array &$array, int $heapSize, int $i)
{
    $left = left($i);
    $right = right($i);

    if ($left <= $heapSize && $array[$left] > $array[$i]) {
        $largest = $left;
    } else {
        $largest = $i;
    }

    if ($right <= $heapSize && $array[$right] > $array[$largest]) {
        $largest = $right;
    }

    if ($largest != $i) {
        exchange($array[$i], $array[$largest]);
        maxHeapify($array, $heapSize, $largest);
    }
}

/**
 * @param $array
 */
function buildMaxHeap(&$array)
{
    $heapSize = count($array);
    $numLoop = floor($heapSize/2);
    for ($i = $numLoop; $i >= 1; $i--) {
        maxHeapify($array, $heapSize, $i);
    }
}

/**
 * @param int $i
 * @return int
 */
function left(int $i): int
{
    return 2 * $i;
}

/**
 * @param int $i
 * @return int
 */
function right($i):int
{
    return 2 * $i + 1;
}
