<?php
session_start();
require_once('includes/adminAut.inc.php');
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
require_once('templates/nav.php');
require_once('sql/DB.php');
require_once('classes/tourEdit.classes.php');
$tourEdit = new tourEdit();
if(isset($_GET['id'])) {

    $GETid = $_GET['id'];
    $crudData = $tourEdit->selectEditData($_GET['id']);
    $tipusok = $tourEdit->selectTipusok();
    $szintek = $tourEdit->selectSzintek();
    $lokacio = $tourEdit->selectLokaciok();
    $cimke = $tourEdit->selectCimkek();
    $cimkeID = $tourEdit->selectCimkeID($_GET['id']);
}

require_once('includes/tourEdit.inc.php');

?>

    <a href="admin.php">Vissza</a>
    <div>
        <?php if($status === "success"): ?>
            <h1><?php echo 'siker' ?></h1>
        <?php endif ?>
    </div>
    
    <div class="div-newTour">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" class="newTour">

        <label for="turaNev">Túra neve</label>
        <input type="text" name="turaNev" value ="<?php echo $crudData['turaNev']?>">

        <label for="turaTipus">Túra típusa</label>
        <select name="turaTipus">
            <?php foreach ($tipusok as $key) : ?>
                <option value="<?php echo $key['id'] ?>"
                <?php echo ($key['tipus'] === $crudData['tipus']) ?  "selected" : "" ?>>
                <?php echo $key['tipus'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <label for="turaSzint">Túra szint</label>
        <select name="turaSzint">
        <?php foreach ($szintek as $key) : ?>
                <option value="<?php echo $key['id'] ?>"
                <?php echo ($key['szint'] === $crudData['szint']) ?  "selected" : "" ?>>
                <?php echo $key['szint'] ?>
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
        <?php foreach ($lokacio as $key) : ?>
                <option value="<?php echo $key['id'] ?>"
                <?php echo ($key['lokacio'] === $crudData['lokacio']) ?  "selected" : "" ?>>
                <?php echo $key['lokacio'] ?>
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

        <input type="hidden" name="getid" value="<?php echo $GETid; ?>">

        <input type="submit" value="Szerkesztés" name="edit" >
    </form>
    </div>

<?php
require_once('templates/footer.php');
?>
</body>
</html>