<?php

/**
 * @param int $arraySize
 * @return array
 */
function createRandomArray(int $arraySize): array
{
    $array = [];
    for ($i = 0; $i < $arraySize; $i++) {
        $array[] = rand(1, 9);
    }

    return $array;
}

/**
 * @param array $array
 * @return array
 */
function convertArrayStartFromOne(array $array): array
{
    return array_combine(range(1, count($array)), array_values($array));
}
