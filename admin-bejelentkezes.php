<?php
include_once 'templates/nav.php';
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
    <div class="form-login">
        <form action="includes/adminlogin.inc.php" method="post">
            <h1>Admin bejelentkezés</h1>
            <input type="text" name="uid" placeholder="felhasználónév">
            <input type="password" name="pwd" placeholder="jelszó">
            <button type="submit" name="adminsubmit">Bejelentkezés</button>
        </form>
    </div>

<?php
include_once 'templates/footer.php';
?>

