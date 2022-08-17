<?php
include_once 'includes/adminlogin.inc.php';
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

    <?php if($status === 'success'): ?>
        <h1>Sikeres bejelentkezés</h1> 
    <?php elseif($status === 'loginerror'): ?>
        <h1>Sikertelen bejelentkezés</h1>
        <p><?php echo $errors['empty'] ?? '' ?></p>
        <?php echo $errors['wrong'] ?? '' ?>
    <?php endif ?> 

    <div class="form-login">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <h1>Admin bejelentkezés</h1>
            <input type="text" name="uid" placeholder="felhasználónév" value="<?= $_POST['uid'] ?? ''?>">
            <input type="password" name="pwd" placeholder="jelszó">
            <button type="submit" name="adminsubmit">Bejelentkezés</button>
        </form>
    </div>

<?php
include_once 'templates/footer.php';
?>

