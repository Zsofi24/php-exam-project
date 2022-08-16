<?php
session_start();
?>
<?php
require_once "./sql/DB.php";
$db = new DB();
if($db->getConnect()) {
   
    $box = $db->selectBox();
   
    foreach ($box as $key => $value) {
        $leiras[] = $db->cut($value['leiras'], 200);
    } 
   
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
<div class="box">

    <?php foreach ($box as $key => $value) {
    
    
    ?>
        <section class="tura">
            <div class="img">
                <img src="img/<?php echo $value['kepNev'];?>" alt="<?php echo $value['kepCim'];?>">
            </div>
            <h1><?php echo $value['turaNev']; ?></h1>
            <p><?php echo $leiras[$key]; ?></p>
            <a href="turainfo.php?id=<?php echo $value['turaId']?>">Leírás</a>
        </section>
    <?php
    }
    ?>


</div>

<?php
include_once 'templates/footer.php';
?>

