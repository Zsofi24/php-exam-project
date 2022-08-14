<?php
require_once "./sql/DB.php";
$db = new DB();
if($db->getConnect()) {
    echo $_GET['id'];
    

} else {
    echo "no";
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/bee62954a8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<?php

include_once 'templates/nav.php';

?>

