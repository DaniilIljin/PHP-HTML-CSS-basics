<?php

$data = $argv[1]; // read customer code from program parameters
//$data = "222";
// use database.php to get customer info from customer code
$costomerAsString = shell_exec("php database.php " . $data);
$output = shell_exec("php display.php '" . $costomerAsString. "'");
// print the converted data.
print $output;