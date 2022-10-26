<?php

$data = $_GET['text'] ?? '';
$confirmed = isset($_GET['confirmed']);
if(!$confirmed){
    $data = urlencode($data);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>

<?php if($confirmed) {
    print "Confirmed: $data";
} else {
    print "<a href='.'>Cancel</a> ";
    print "<a href='receiver.php?confirmed=1&text=$data'>Confirm</a>";
}

?>

</body>
</html>
