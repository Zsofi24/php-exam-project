<?php
session_start();
?>

<?php
require_once('templates/nav.php');
require_once('sql/DB.php');
require_once('classes/crud.classes.php');
$crud = new Crud();
$crudData = $crud->selectEditData($_GET['id']);
$tipusok = $crud->selectTipusok();
$szintek = $crud->selectSzintek();
$lokacio = $crud->selectLokaciok();
$cimke = $crud->selectCimkek();
$cimkeID = $crud->selectCimkeID($_GET['id']);


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
        <?php foreach ($cimke as $key) : ?>
            <label class="label checkbox" for="cimke[]" ><?php echo $key['cimke']?> 
                <input type="checkbox" name="cimke[]" value="<?php echo $key['id'] ?>" 
                <?php foreach ($cimkeID as $value) { ?>
                    <?php echo ($key['cimke'] === $value ? "checked" : "") ?>
                <?php } ?>
            ></label>
        <?php endforeach ?>

        <label for="teljesitesIdo">Teljesítési idő (óra)</label>
        <input type="number" name="teljesitesIdo" min="1" max="50" value ="<?php echo $crudData['ido']?>">

        <label for="turaHossz">Túra hossz (km)</label>
        <input type="number" name="turaHossz" min="1" max="100" value ="<?php echo $crudData['hossz']?>">

        <input type="submit" value="Szerkesztés" name="submit" >
    </form>
    </div>
</body>
</html>