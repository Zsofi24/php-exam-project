<?php
session_start();
?>

<?php
require_once('includes/tours.inc.php');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Túrák</title>
    <script src="https://kit.fontawesome.com/bee62954a8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<?php
require_once('templates/nav.php');
?>

<?php foreach ($locations as $key => $value): ?>
    <?php $id = $locations[$key]['helyszinId'] ?>
    <?php $name = $locations[$key]['helyszinNev'] ?>
    <div class="tours">
    <h1 class="toursH1" id="<?php echo $id ?>"><?php echo $name?></h1>
    </div>

    
    <div class="box">
        <?php foreach ($box[$key] as $keyy => $value): ?>
            <a class="bigLink" href="tourInfo.php?id=<?php echo $box[$key][$keyy]['turaId']?>">
            <section class="tura">
                <div class="img">
                    <img src="img/<?php echo $box[$key][$keyy]['kepNev'];?>" alt="<?php echo $box[$key][$keyy]['kepCim'];?>">
                </div>
                <h1><?php echo $box[$key][$keyy]['turaNev']; ?></h1>
                <p><?php echo $leiras[$key][$keyy]; ?></p>
                <a class ="smallLink" href="tourInfo.php?id=<?php echo $box[$key][$keyy]['turaId']?>">Leírás</a>
            </section>
            </a>
        <?php endforeach ?>
    </div>

<?php endforeach ?>

<?php
include_once 'templates/footer.php';
?>
