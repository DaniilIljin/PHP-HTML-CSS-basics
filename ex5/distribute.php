<?php

function distributeToSets(array $input) : array {
    $sets = [];
    foreach ($input as$each){
        if (isset($sets[$each])){
            $sets[$each][] = $each;
        }
        else
        {
            $sets[$each] = [$each];
        }
    }

    return $sets;
}
