<?php

$inputList = [1, 4, 2, 0];

 $listAsString = join(", ", $inputList);

 $restoredList = array_map(fn($each) => intval($each), explode(", ", $listAsString));

// check that the restored list is the same as the input list.
 print var_dump($restoredList === $inputList);

