<?php
require_once('templates/nav.php');
require_once('includes/signup.inc.php');
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
        <h1>Sikeres regisztráció</h1> 
    <?php elseif($status === 'signuperror'): ?>
        <h1>Sikertelen regisztráció</h1>
        <p><?php echo $errors['empty'] ?? '' ?></p>
    <?php endif ?>

    <div class="form-regist">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <h1>Regisztráció</h1>
            <label for="uid">Felhasználónév</label>
            <input type="text" name="uid" placeholder="felhasználónév" value="<?= $_POST['uid'] ?? ''?>">
            <div class="error">
                <p><?php echo $errors['uid'] ?? '' ?></p>
                <p><?php echo $errors['taken'] ?? '' ?></p>
            </div>

            <label for="email">E-mail cím</label>
            <input type="email" name="email" placeholder="e-mail cím" value="<?= $_POST['email'] ?? ''?>">
            <div class="error">
                <p><?php echo $errors['email'] ?? '' ?></p>
                <p><?php echo $errors['taken'] ?? '' ?></p>
            </div>

            <label for="pwd">Jelszó</label>
            <input type="password" name="pwd" placeholder="jelszó">
            <div class="error">
                <p><?php echo $errors['pwdmatch'] ?? '' ?></p>
            </div>

            <label for="pwdrepeat">Ismételt jelszó</label>
            <input type="password" name="pwdrepeat" placeholder="ismételt jelszó">
            <div class="error">
                <p><?php echo $errors['pwdmatch'] ?? '' ?></p>
            </div>
            <button type="submit" name="submit">regisztráció</button>
        </form>
    </div>

<?php
require_once('templates/footer.php');
?>
