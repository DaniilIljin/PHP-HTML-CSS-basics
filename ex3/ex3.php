<?php

$numbers = [1, 2, 5, 6, 2, 11, 2, 7];

//var_dump(getOddNumbers($numbers));

function getOddNumbers($list) {
    return array_values(array_filter($list, fn($each) => $each % 2 === 1));
}