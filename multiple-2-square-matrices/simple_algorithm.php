<?php
include_once 'matrix.php';

/**
 * @param int $matrixSize
 * @param array $matrixA
 * @param array $matrixB
 * @return array
 */
function multipleMatrixBySimpleAlgorithm(int $matrixSize, array $matrixA, array $matrixB): array
{
    if (log($matrixSize, 2) != round(log($matrixSize, 2))) {
        exit('Matrix size is not an exact power of 2');
    }

    if ($matrixSize == 1) {
        $resultMatrix[0][0] = $matrixA[0][0] * $matrixB[0][0];
        return $resultMatrix;
    } else {
        $newMatrixSize = intval($matrixSize / 2);
        $matrixA11 = getSubsetsOfMatrix(0, 0, $newMatrixSize - 1, $newMatrixSize - 1, $matrixA);
        $matrixA12 = getSubsetsOfMatrix(0, $newMatrixSize, $newMatrixSize - 1, $matrixSize - 1, $matrixA);
        $matrixA21 = getSubsetsOfMatrix($newMatrixSize, 0, $matrixSize - 1, $newMatrixSize - 1, $matrixA);
        $matrixA22 = getSubsetsOfMatrix($newMatrixSize, $newMatrixSize, $matrixSize - 1, $matrixSize - 1, $matrixA);

        $matrixB11 = getSubsetsOfMatrix(0, 0, $newMatrixSize - 1, $newMatrixSize - 1, $matrixB);
        $matrixB12 = getSubsetsOfMatrix(0, $newMatrixSize, $newMatrixSize - 1, $matrixSize - 1, $matrixB);
        $matrixB21 = getSubsetsOfMatrix($newMatrixSize, 0, $matrixSize - 1, $newMatrixSize - 1, $matrixB);
        $matrixB22 = getSubsetsOfMatrix($newMatrixSize, $newMatrixSize, $matrixSize - 1, $matrixSize - 1, $matrixB);

        $resultMatrix11 = addMatrix(
            $newMatrixSize,
            multipleMatrixBySimpleAlgorithm($newMatrixSize, $matrixA11, $matrixB11),
            multipleMatrixBySimpleAlgorithm($newMatrixSize, $matrixA12, $matrixB21)
        );

        $resultMatrix12 = addMatrix(
            $newMatrixSize,
            multipleMatrixBySimpleAlgorithm($newMatrixSize, $matrixA11, $matrixB12),
            multipleMatrixBySimpleAlgorithm($newMatrixSize, $matrixA12, $matrixB22)
        );

        $resultMatrix21 = addMatrix(
            $newMatrixSize,
            multipleMatrixBySimpleAlgorithm($newMatrixSize, $matrixA21, $matrixB11),
            multipleMatrixBySimpleAlgorithm($newMatrixSize, $matrixA22, $matrixB21)
        );

        $resultMatrix22 = addMatrix(
            $newMatrixSize,
            multipleMatrixBySimpleAlgorithm($newMatrixSize, $matrixA21, $matrixB12),
            multipleMatrixBySimpleAlgorithm($newMatrixSize, $matrixA22, $matrixB22)
        );

        $resultMatrix = createMatrixFromSubsets($newMatrixSize, $resultMatrix11, $resultMatrix12, $resultMatrix21, $resultMatrix22);

        return $resultMatrix;
    }
}
