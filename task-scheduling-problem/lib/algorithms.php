<?php
/**
 * @param array $a
 * @param array $b
 * @return int
 */
function comparePenalty(array $a, array $b): int
{
    if ($a['penalty'] < $b['penalty']) {
        return 1;
    }

    if ($a['penalty'] == $b['penalty']) {
        if ($a['id'] > $b['id']) {
            return 1;
        }
    }

    return -1;
}

/**
 * @param array $a
 * @param array $b
 * @return int
 */
function compareDeadline(array $a, array $b): int
{
    if ($a['deadline'] > $b['deadline']) {
        return 1;
    }

    if ($a['deadline'] == $b['deadline']) {
        if ($a['id'] > $b['id']) {
            return 1;
        }
    }

    return -1;
}

/**
 * @param array $a
 * @param array $b
 * @return int
 */
function compareId(array $a, array $b): int
{
    if ($a['id'] > $b['id']) {
        return 1;
    }

    return -1;
}

/**
 * @param int $numOfTasks
 * @param array $arrayInput
 * @return array
 */
function taskSchedulingAlgorithm(int $numOfTasks, array $arrayInput): array
{
    // Sort array penalties
    usort($arrayInput, 'comparePenalty');

    $arrayEarlyTasks = [];
    $arrayLateTasks = [];
    $slot = [];
    $result = [];
    for ($i = 0; $i < $numOfTasks; $i++) {
        $slot[$i] = false;
    }

    for ($i = 0; $i < $numOfTasks; $i++) {
        $foundSlot = false;
        for ($j = min($arrayInput[$i]['deadline'], $numOfTasks) - 1; $j >= 0; $j--) {
            if ($slot[$j] === false) {
                $arrayEarlyTasks[] = $arrayInput[$i];
                $slot[$j] = true;
                $foundSlot = true;
                break;
            }
        }

        if (!$foundSlot) {
            $arrayLateTasks[] = $arrayInput[$i];
        }
    }

    usort($arrayEarlyTasks, 'compareDeadline');
    usort($arrayLateTasks, 'compareId');

    foreach ($arrayEarlyTasks as $item) {
        $result[] = $item['id'];
    }

    foreach ($arrayLateTasks as $item) {
        $result[] = $item['id'];
    }
    return $result;
}
