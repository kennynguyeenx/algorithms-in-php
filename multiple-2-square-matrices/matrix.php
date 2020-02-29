<?php

/**
 * @param int $matrixSize
 * @return array
 */
function createRandomMatrix(int $matrixSize): array
{
    $matrix = [];
    for ($i = 0; $i < $matrixSize; $i++) {
        $row = '';
        for ($j = 0; $j < $matrixSize; $j++) {
            $row .= rand(1, 9) . ' ';
        }
        $matrix[] = trim($row);
    }

    return $matrix;
}

/**
 * @param int $matrixSize
 * @param array $tempMatrix
 * @return array
 */
function readMatrix(int $matrixSize, array $tempMatrix): array
{
    $matrix = [];
    for ($i = 0; $i < $matrixSize; $i++) {
        $temp = explode(' ', $tempMatrix[$i]);
        for ($j = 0; $j < $matrixSize; $j++) {
            $matrix[$i][$j] = $temp[$j];
        }
    }

    return $matrix;
}

/**
 * @param $handle
 * @param int $matrixSize
 * @param array $matrix
 */
function writeMatrix($handle, int $matrixSize, array $matrix)
{
    for ($i = 0; $i < $matrixSize; $i++) {
        $row = implode(' ', $matrix[$i]);
        fwrite($handle, $row . PHP_EOL);
    }
}

/**
 * @param int $matrixSize
 * @param array $matrixA
 * @param array $matrixB
 * @return array
 */
function addMatrix(int $matrixSize, array $matrixA, array $matrixB): array
{
    $resultMatrix = [];
    for ($i = 0; $i < $matrixSize; $i++) {
        for ($j = 0; $j < $matrixSize; $j++) {
            $resultMatrix[$i][$j] = $matrixA[$i][$j] + $matrixB[$i][$j];
        }
    }

    return $resultMatrix;
}

/**
 * @param int $matrixSize
 * @param array $matrixA
 * @param array $matrixB
 * @return array
 */
function subtractMatrix(int $matrixSize, array $matrixA, array $matrixB): array
{
    $resultMatrix = [];
    for ($i = 0; $i < $matrixSize; $i++) {
        for ($j = 0; $j < $matrixSize; $j++) {
            $resultMatrix[$i][$j] = $matrixA[$i][$j] - $matrixB[$i][$j];
        }
    }

    return $resultMatrix;
}

/**
 * @param int $startRow
 * @param int $startCol
 * @param int $endRow
 * @param int $endCol
 * @param array $matrix
 * @return array
 */
function getSubsetsOfMatrix(int $startRow, int $startCol, int $endRow, int $endCol, array $matrix): array
{
    $resultMatrix = [];
    $rowIndex = 0;
    for ($i = $startRow; $i <= $endRow; $i++) {
        $colIndex = 0;
        for ($j = $startCol; $j <= $endCol; $j++) {
            $resultMatrix[$rowIndex][$colIndex] = $matrix[$i][$j];
            $colIndex++;
        }
        $rowIndex++;
    }

    return $resultMatrix;
}

/**
 * @param int $subSetMatrixSize
 * @param array $matrix11
 * @param array $matrix12
 * @param array $matrix21
 * @param array $matrix22
 * @return array
 */
function createMatrixFromSubsets(
    int $subSetMatrixSize,
    array $matrix11,
    array $matrix12,
    array $matrix21,
    array $matrix22
): array {
    $resultMatrix = [];
    for ($i = 0; $i < $subSetMatrixSize; $i++) {
        for ($j = 0; $j < $subSetMatrixSize; $j++) {
            $resultMatrix[$i][$j] = $matrix11[$i][$j];
            $resultMatrix[$i][$j + $subSetMatrixSize] = $matrix12[$i][$j];
            $resultMatrix[$i + $subSetMatrixSize][$j] = $matrix21[$i][$j];
            $resultMatrix[$i + $subSetMatrixSize][$j + $subSetMatrixSize] = $matrix22[$i][$j];
        }
    }

    return $resultMatrix;
}
