<?php

$header = file_get_contents('tpl/table-header.html');
$footer = file_get_contents('tpl/table-footer.html');

print $header;

foreach (range(0, 9) as $first) {
    print '<div>'.PHP_EOL;
    foreach (range(0, 9) as $second) {
        $multiply = $first * $second;
        printf("$first x $second = $multiply<br>");
    }
    print '</div>'.PHP_EOL;
}

print  $footer;