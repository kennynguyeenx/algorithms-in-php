<?php
/**
 * @param array $arrayTimeAppear
 * @param array $arrayAnimalsHeight
 * @return array
 */
function algorithm(array $arrayTimeAppear, array $arrayAnimalsHeight): array
{
    $sumDisappearTime = 0;
    $arrayTap = [];
    $arrayTapNeed = $arrayAnimalsHeight;
    $time = 1;
    asort($arrayTapNeed);

    while(count($arrayTapNeed)) {
        $arrayTap[$time] = 0;

        foreach ($arrayTapNeed as $key => $value) {
            if ($time >= $arrayTimeAppear[$key]) {
                $arrayTap[$time] = $key;
                $needTap = $value - 1;
                if ($needTap == 0) {
                    $sumDisappearTime += $time;
                    unset($arrayTapNeed[$key]);
                } else {
                    $arrayTapNeed[$key] = $needTap;
                }
                asort($arrayTapNeed);
                break;
            }
        }

        $time++;
    }

    $result = [
        'sumDisappearTime' => $sumDisappearTime,
        'arrayTap' => $arrayTap
    ];

    return $result;
}
