<?php

$data = $_GET['text'] ?? '';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>

Received:

<pre><?= urldecode($data) ?></pre>

</body>
</html>
