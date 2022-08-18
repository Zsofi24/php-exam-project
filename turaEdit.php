<?php
session_start();
?>

<?php
require_once('templates/nav.php');
require_once('sql/DB.php');
require_once('classes/crud.classes.php');
$crud = new Crud();
$crudData = $crud->selectEditData1($_GET['id']);
$tipusok = $crud->selectTipusok();
$szintek = $crud->selectSzintek();
$lokacio = $crud->selectLokaciok();

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

    <div class="div-newTour">
        <form action="turaEdit.classes.php" method="post" enctype="multipart/form-data" class="newTour">

        <label for="turaNev">Túra neve</label>
        <input type="text" name="turaNev" value ="<?php echo $crudData['turaNev']?>">

        <label for="turaTipus">Túra típusa</label>
        <select name="turaTipus">
            <?php foreach ($tipusok as $value) : ?>
                <option value="<?php echo $value;?>" name="<?php echo $value;?>" 
                <?php echo ($value === $crudData['tipus']) ?  "selected" : "" ?>>
                <?php echo $value;?>
                </option>
            <?php endforeach ?>
        </select>

        <label for="turaSzint">Túra szint</label>
        <select name="turaSzint">
            <?php foreach ($szintek as $value) : ?>
                <option value="<?php echo $value;?>" name="<?php echo $value;?>" 
                <?php echo ($value === $crudData['szint']) ?  "selected" : "" ?>>
                <?php echo $value;?>
                </option>
            <?php endforeach ?>
        </select>

        <label for="leiras">Leírás</label>
        <textarea  name="leiras" ><?php echo $crudData['leiras']?></textarea>

        <label for="kepFile">Kép kiválasztása</label>
        <input type="file" name="kepFile">

        <label for="kepCim">Kép cím (alt tag)</label>
        <input type="text" name="kepCim" value ="<?php echo $crudData['kepCim']?>">

        <label for="lokacio">Lokáció</label>
        <select name="lokcaio">
            <?php foreach ($lokacio as $value) : ?>
                <option value="<?php echo $value;?>" name="<?php echo $value;?>" 
                <?php echo ($value === $crudData['lokacio']) ?  "selected" : "" ?>>
                <?php echo $value;?>
                </option>
            <?php endforeach ?>
        </select>

        <label for="cimke">Cimkék</label>
        <input type="checkbox" name="cimkek" value="<?php ?>">
        <label for="cimkek"><?php ?></label>
        <!-- <select name="cimke[]" multiple size="6">
            <option value="1" name="1">Szép kilátás</option>
            <option value="2" name="2">Kerékpártúra</option>
            <option value="3" name="3">Család- és gyerekbarát</option>
            <option value="4" name="4">Különleges élővilág</option>
            <option value="5" name="5">Kirándulások 10km alatt</option>
            <option value="6" name="6">Vízitúra</option>
            <option value="7" name="7">Kultúrális/történelmi értékek</option>
            <option value="8" name="8">Körtúra</option>
            <option value="9" name="9">Kilátó</option>
            <option value="10" name="10">Kirándulások 15km alatt</option>
            <option value="11" name="11">Gyalogtúra</option>
        </select> -->

        <label for="teljesitesIdo">Teljesítési idő (óra)</label>
        <input type="number" name="teljesitesIdo" min="1" max="50" value ="<?php echo $crudData['ido']?>">

        <label for="turaHossz">Túra hossz (km)</label>
        <input type="number" name="turaHossz" min="1" max="100" value ="<?php echo $crudData['hossz']?>">

        <input type="submit" value="Szerkesztés" name="submit" >
    </form>
    </div>
</body>
</html>