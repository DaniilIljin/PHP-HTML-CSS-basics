<?php

$data = $_POST['data'] ?? '';
error_log($data);

$url = 'index.php?message=' . urlencode("Data saved!\nabc");

header('Location: ' . $url);
