<?php
session_start();
?>

<?php
require_once 'includes/turak.inc.php';
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
<div class="tours">
<h1 class="toursH1">Csoportos, vezetett túrák</h1>
</div>

<div class="box">

    <?php foreach ($box as $key => $value): ?>
        <a class="bigLink" href="turainfo.php?id=<?php echo $value['turaId']?>">
        <section class="tura">
            <div class="img">
                <img src="img/<?php echo $value['kepNev'];?>" alt="<?php echo $value['kepCim'];?>">
            </div>
            <h1><?php echo $value['turaNev']; ?></h1>
            <p><?php echo $leiras[$key]; ?></p>
            <a class ="smallLink" href="turainfo.php?id=<?php echo $value['turaId']?>">Leírás</a>
        </section>
        </a>
    <?php
    endforeach
    ?>

</div>

<?php
include_once 'templates/footer.php';
?>
