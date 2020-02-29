<?php
include_once 'partition.php';
include_once 'heap.php';
include_once 'sort.php';

/**
 * @param array $array
 * @param int $p
 * @param int $r
 * @param int $index
 * @return mixed
 */
function randomizedSelect(array &$array, int $p, int $r, int $index)
{
    if ($p == $r) {
        return $array[$p];
    }

    $q = randomizedPartition($array, $p, $r);
    $k = $q - $p + 1;
    if ($index == $k) {
        return $array[$q];
    } else if ($index < $k) {
        return randomizedSelect($array, $p, $q - 1, $index);
    } else {
        return randomizedSelect($array, $q + 1, $r, $index - $k);
    }
}

/**
 * @param array $array
 * @param int $p
 * @param int $r
 * @param int $index
 * @return mixed
 */
function linearWorstCaseSelect(array &$array, int $p, int $r, int $index)
{
    if ($p == $r) {
        return $array[$p];
    }

    $arrayMedian = [];
    for ($i = $p; $i <= $r; $i+=5) {
        $subArray = array_slice($array, $i, 5);
        $arrayMedian[] = getMedianSimple($subArray, count($subArray));
    }

    if (count($arrayMedian) == 1) {
        $medianOfMedians = $arrayMedian[0];
    } else {
        $sizeOfMedianArray = count($arrayMedian);
        $medianOffset = floor($sizeOfMedianArray / 2);
        $medianOfMedians = linearWorstCaseSelect($arrayMedian, 0, $sizeOfMedianArray - 1, $medianOffset);
    }

    $q = partitionWithPivot($array, $p, $r, $medianOfMedians);
    $k = $q - $p + 1;
    if ($index == $k) {
        return $array[$q];
    } else if ($index < $k) {
        return linearWorstCaseSelect($array, $p, $q - 1, $index);
    } else {
        return linearWorstCaseSelect($array, $q + 1, $r, $index - $k);
    }
}

/**
 * @param array $array
 * @param int $n
 * @return int
 */
function getMedianSimple(array $array, int $n): int
{
    sort($array);
    $medianIndex = floor(($n + 1) / 2) - 1;
    return $array[$medianIndex];
}

/**
 * @param array $array
 * @param int $numElementsNeedGet
 * @return array
 */
function randomizedSelectKElements(array $array, int $numElementsNeedGet): array
{
    $result = [];
    $arrayMaxIndex = count($array) - 1;
    for ($i = 1; $i <= $numElementsNeedGet; $i++) {
        $result[] = randomizedSelect($array, 0, $arrayMaxIndex, $i);
    }
    return $result;
}

/**
 * @param array $array
 * @param int $numElementsNeedGet
 * @return array
 */
function linearWorstCaseSelectKElements(array $array, int $numElementsNeedGet): array
{
    $result = [];
    $arrayMaxIndex = count($array) - 1;
    for ($i = 1; $i <= $numElementsNeedGet; $i++) {
        $result[] = linearWorstCaseSelect($array, 0, $arrayMaxIndex, $i);
    }
    return $result;
}

/**
 * @param array $array
 * @param int $numElementsNeedGet
 * @return array
 */
function heapSortSeletKElements(array $array, int $numElementsNeedGet): array
{
    $array = convertArrayStartFromOne($array);
    heapSort($array);
    return array_slice($array, 0, $numElementsNeedGet);
}

/**
 * @param array $array
 * @param int $numElementsNeedGet
 * @return array
 */
function myAlgorithmSelectKElements(array $array, int $numElementsNeedGet): array
{
    $array = convertArrayStartFromOne($array);
    buildMinHeap($array);
    $heapSize = $arraySize = count($array);
    $index = $arraySize - $numElementsNeedGet;
    for ($i = $arraySize; $i > $index; $i--) {
        exchange($array[1], $array[$i]);
        minHeapify($array, --$heapSize, 1);
    }

    return array_reverse(array_slice($array, $index, $numElementsNeedGet));
}
