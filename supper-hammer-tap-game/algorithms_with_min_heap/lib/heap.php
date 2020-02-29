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

    if ($left <= $heapSize && $array[$left]['timeToLive'] < $array[$i]['timeToLive']) {
        $smallest = $left;
    } else {
        $smallest = $i;
    }

    if ($right <= $heapSize && $array[$right]['timeToLive'] < $array[$smallest]['timeToLive']) {
        $smallest = $right;
    }

    if ($smallest != $i) {
        exchange($array[$i], $array[$smallest]);
        minHeapify($array, $heapSize, $smallest);
    }
}

/**
 * @param array $array
 */
function buildMinHeap(array &$array)
{
    $heapSize = count($array);
    $numLoop = floor($heapSize/2);
    for ($i = $numLoop; $i >= 1; $i--) {
        minHeapify($array, $heapSize, $i);
    }
}

/**
 * @param $array
 * @return mixed
 */
function heapMinimum(array $array)
{
    return $array[1];
}

/**
 * @param $array
 * @return mixed
 */
function heapExtractMin(array &$array)
{
    $arraySize = count($array);
    if ($arraySize < 1) {
        die('Heap underflow');
    }
    $min = $array[1];
    $array[1] = $array[$arraySize];
    unset($array[$arraySize]);
    minHeapify($array, count($array), 1);
    return $min;
}

/**
 * @param array $array
 * @param int $i
 * @param array $item
 */
function heapDecreaseKey(array &$array, int $i, array $item)
{
    if ($item['timeToLive'] > $array[$i]['timeToLive']) {
        die('New key is greater than current key');
    }
    $array[$i] = $item;
    while ($i > 1 && $array[parent($i)]['timeToLive'] > $array[$i]['timeToLive']) {
        exchange($array[$i], $array[parent($i)]);
        $i = parent($i);
    }
}

/**
 * @param array $array
 * @param array $item
 */
function minHeapInsert(array &$array, array$item)
{
    $arraySize = count($array) + 1;
    $array[$arraySize] = [
        'id' => 'temp',
        'timeAppear' => 'temp',
        'timeToLive' => 999999999999999999];
    heapDecreaseKey($array, $arraySize, $item);
}

/**
 * @param int $i
 * @return int
 */
function left($i): int
{
    return 2 * $i;
}

/**
 * @param int $i
 * @return int
 */
function right(int $i): int
{
    return 2 * $i + 1;
}

/**
 * @param int $i
 * @return int
 */
function parent(int $i): int
{
    return intval(floor($i / 2));
}
