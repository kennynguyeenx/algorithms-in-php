<?php
/**
 * @param $a
 * @param $b
 */
function exchange(&$a, &$b)
{
    $temp = $a;
    $a = $b;
    $b = $temp;
}
