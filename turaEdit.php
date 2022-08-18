<?php
session_start();
?>

<?php
require_once('templates/nav.php');
require_once('sql/DB.php');
require_once('classes/crud.classes.php');
$crud = new Crud();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <div class="editForm">
        <form action="" method="post">
            
        </form>
    </div>
</body>
</html>