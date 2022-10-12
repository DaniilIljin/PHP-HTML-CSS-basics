<?php
$temp = $_POST["temperature"] ?? "";
if(empty($temp)){
    $message = "Insert temperature";
} elseif (!is_numeric($temp)){
    $message = "Temperature must be an integer";
} else {
    $message = sprintf("%s egrees in Fahrenheit is %s degrees in Celsius",
    $temp, f2c($temp));
}
function f2c($temp){
    return (intval($temp) - 32) / (9/5);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fahrenheit to Celsius</title>
</head>
<body>

    <nav>
        <a id="c2f" href="index.html">Celsius to Fahrenheit</a> |
        <a id="f2c" href="f2c.html">Fahrenheit to Celsius</a>
    </nav>

    <main>

        <h3>Fahrenheit to Celsius</h3>
        <em><?= $message ?></em>

    </main>

</body>
</html>
