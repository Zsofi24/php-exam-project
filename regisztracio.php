<?php
include_once 'templates/nav.php';
include_once 'includes/signup.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
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
    if(!empty($errors)):
        foreach ($errors as $value):
            ?> <p><?php echo $value ?></p>
    <?php endforeach;
    endif;
    ?>

    <div class="form-regist">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <h1>Regisztráció</h1>
            <input type="text" name="uid" placeholder="felhasználónév">
            <input type="password" name="pwd" placeholder="jelszó">
            <input type="password" name="pwdrepeat" placeholder="ismételt jelszó">
            <input type="email" name="email" placeholder="email">
            <button type="submit" name="submit">regisztráció</button>
        </form>
    </div>

<?php
include_once 'templates/footer.php';
?>