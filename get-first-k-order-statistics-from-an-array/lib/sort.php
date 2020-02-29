<?php
include_once 'heap.php';
include_once 'helper.php';

/**
 * @param $array
 */
function heapSort(array &$array)
{
    buildMaxHeap($array);
    $heapSize = $arraySize = count($array);
    for ($i = $arraySize; $i >= 2; $i--) {
        exchange($array[1], $array[$i]);
        maxHeapify($array, --$heapSize, 1);
    }
}
