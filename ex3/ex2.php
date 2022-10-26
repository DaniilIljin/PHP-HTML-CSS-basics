<?php

$list = [1, 2, 3, 2, 6];

function isInList($list, $target) {
    $aray = array_filter($list, fn($each) => $each === $target);
    return count($aray) != 0;
}






