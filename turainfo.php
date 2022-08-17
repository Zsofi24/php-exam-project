<?php
session_start();
?>

<?php
require_once 'sql/DB.php';

require_once 'includes/turainfo.inc.php';
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



<div class="container-turainfo">
    <div class="img-turainfo">
    <img src="img/<?php echo $kep[0]?>" alt="<?php echo $kep[1]?>">
    </div>
    <h1><?php echo $nev; ?></h1>
    <div class="cimke">
        <?php
        foreach ($cimke as $value) {
            ?>
            <div><?php echo $value; ?></div>
            <?php
        }
        ?>
    </div>
    <div class="cont">
        <article>
           <p><?php echo $leiras ?></p>
        </article>
        <div class="adatok">
            <p>Szint: <?php echo $szinttipus['szint']?></p>
            <p>Típus: <?php echo $szinttipus['tipus']?> </p>

            <p>Helyszín: <?php echo $lokacio ?> </p>

            <p>Teljesítési idő: <?php echo $idohossz['ido']?> óra</p>
            <p>Túra hossz: <?php echo $idohossz['hossz']?> km </p>


        </div>
    </div>
</div>



