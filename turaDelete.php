<?php
session_start();
?>

<?php
include_once ('includes/turaDelete.inc.php');
require_once('templates/nav.php');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="https://kit.fontawesome.com/bee62954a8.js" crossorigin="anonymous"></script>
</head>
<body>

<?php


// require_once('sql/DB.php');
// require_once('classes/turaDelete.classes.php');
//$id = $_GET['id'];
//$turaDelete = new turaDelete();
?>


    <div class="form-login">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <h1>Biztosan törölni szeretné?</h1>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? ''?>">
            <a href="admin.php">Nem</a>            
            <button type="submit" name="delete">Igen</button>
        </form>
    </div>



<?php
require_once('templates/footer.php');
?>
</body>
</html>