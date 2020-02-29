<?php
/**
 * @param array $array
 * @return array
 */
function convertArrayStartFromOne(array $array): array
{
    return array_combine(range(1, count($array)), array_values($array));
}
