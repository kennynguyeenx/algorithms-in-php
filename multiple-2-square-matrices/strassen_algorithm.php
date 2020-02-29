<?php
include_once 'matrix.php';

/**
 * @param int $matrixSize
 * @param array $matrixA
 * @param array $matrixB
 * @return array
 */
function multipleMatrixByStrassenAlgorithm(int $matrixSize, array $matrixA, array $matrixB): array
{
    if (log($matrixSize, 2) != round(log($matrixSize, 2))) {
        exit('Matrix size is not an exact power of 2');
    }

    if ($matrixSize == 1) {
        $resultMatrix[0][0] = $matrixA[0][0] * $matrixB[0][0];
        return $resultMatrix;
    } else {
        $newMatrixSize = intval($matrixSize/2);
        $matrixA11 = getSubsetsOfMatrix(0, 0, $newMatrixSize - 1, $newMatrixSize - 1, $matrixA);
        $matrixA12 = getSubsetsOfMatrix(0, $newMatrixSize, $newMatrixSize - 1, $matrixSize - 1, $matrixA);
        $matrixA21 = getSubsetsOfMatrix($newMatrixSize, 0, $matrixSize - 1, $newMatrixSize - 1, $matrixA);
        $matrixA22 = getSubsetsOfMatrix($newMatrixSize, $newMatrixSize, $matrixSize - 1, $matrixSize - 1, $matrixA);

        $matrixB11 = getSubsetsOfMatrix(0, 0, $newMatrixSize - 1, $newMatrixSize - 1, $matrixB);
        $matrixB12 = getSubsetsOfMatrix(0, $newMatrixSize, $newMatrixSize - 1, $matrixSize - 1, $matrixB);
        $matrixB21 = getSubsetsOfMatrix($newMatrixSize, 0, $matrixSize - 1, $newMatrixSize - 1, $matrixB);
        $matrixB22 = getSubsetsOfMatrix($newMatrixSize, $newMatrixSize, $matrixSize - 1, $matrixSize - 1, $matrixB);

        $matrixP1 = multipleMatrixByStrassenAlgorithm(
            $newMatrixSize,
            subtractMatrix($newMatrixSize, $matrixA12,  $matrixA22),
            addMatrix($newMatrixSize, $matrixB21,  $matrixB22)
        );

        $matrixP2 = multipleMatrixByStrassenAlgorithm(
            $newMatrixSize,
            addMatrix($newMatrixSize, $matrixA11,  $matrixA22),
            addMatrix($newMatrixSize, $matrixB11,  $matrixB22)
        );

        $matrixP3 = multipleMatrixByStrassenAlgorithm(
            $newMatrixSize,
            subtractMatrix($newMatrixSize, $matrixA11,  $matrixA21),
            addMatrix($newMatrixSize, $matrixB11,  $matrixB12)
        );

        $matrixP4 = multipleMatrixByStrassenAlgorithm(
            $newMatrixSize,
            addMatrix($newMatrixSize, $matrixA11,  $matrixA12),
            $matrixB22
        );

        $matrixP5 = multipleMatrixByStrassenAlgorithm(
            $newMatrixSize,
            $matrixA11,
            subtractMatrix($newMatrixSize, $matrixB12,  $matrixB22)
        );

        $matrixP6 = multipleMatrixByStrassenAlgorithm(
            $newMatrixSize,
            $matrixA22,
            subtractMatrix($newMatrixSize, $matrixB21,  $matrixB11)
        );

        $matrixP7 = multipleMatrixByStrassenAlgorithm(
            $newMatrixSize,
            addMatrix($newMatrixSize, $matrixA21,  $matrixA22),
            $matrixB11
        );

        $resultMatrix11 = subtractMatrix(
            $newMatrixSize,
            addMatrix($newMatrixSize, addMatrix($newMatrixSize, $matrixP1, $matrixP2), $matrixP6),
            $matrixP4
        );

        $resultMatrix12 = addMatrix(
            $newMatrixSize,
            $matrixP4,
            $matrixP5
        );

        $resultMatrix21 = addMatrix(
            $newMatrixSize,
            $matrixP6,
            $matrixP7
        );

        $resultMatrix22 = subtractMatrix(
            $newMatrixSize,
            addMatrix($newMatrixSize, $matrixP2, $matrixP5),
            addMatrix($newMatrixSize, $matrixP3, $matrixP7)
        );

        $resultMatrix = createMatrixFromSubsets($newMatrixSize, $resultMatrix11, $resultMatrix12, $resultMatrix21, $resultMatrix22);

        return $resultMatrix;
    }
}
