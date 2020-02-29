<?php
include_once 'heap.php';

/**
 * @param array $data
 * @return array
 */
function algorithm(array $data): array
{
    $sumDisappearTime = 0;
    $arrayTap = [];
    $arrayTapNeed = [];
    $time = 1;
    usort($data, 'compareTimeAppear');
    foreach ($data as $index => $item) {
        if ($item['timeAppear'] == $time) {
            // Enqueue
            minHeapInsert($arrayTapNeed, $item);
            unset($data[$index]);
        } else {
            break;
        }
    }

    while(count($arrayTapNeed) || count($data)) {
        $arrayTap[$time] = 0;
        if (count($arrayTapNeed)) {
            $current = heapMinimum($arrayTapNeed);
            $arrayTap[$time] = $current['id'];
            $timeToLive = $current['timeToLive'] - 1;
            if ($timeToLive == 0) {
                $sumDisappearTime += $time;
                heapExtractMin($arrayTapNeed);
            } else {
                $newItem = $current;
                $newItem['timeToLive'] = $timeToLive;
                heapDecreaseKey($arrayTapNeed, 1, $newItem);
            }
        }

        $time++;

        foreach ($data as $index => $item) {
            if ($item['timeAppear'] == $time) {
                // Enqueue
                minHeapInsert($arrayTapNeed, $item);
                unset($data[$index]);
            } else {
                break;
            }
        }
    }

    $result = [
        'sumDisappearTime' => $sumDisappearTime,
        'arrayTap' => $arrayTap
    ];

    return $result;
}

/**
 * @param array $a
 * @param array $b
 * @return int
 */
function compareTimeAppear(array $a, array $b): int
{
    if ($a['timeAppear'] > $b['timeAppear']) {
        return 1;
    }

    if ($a['timeAppear'] == $b['timeAppear']) {
        if ($a['id'] > $b['id']) {
            return 1;
        }
    }

    return -1;
}