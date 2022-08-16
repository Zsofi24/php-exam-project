<!-- <?php
// require_once('<sql/DB.php');
// require_once('classes/crud.classes.php');
//     if(isset($_POST["submit"])) {
//         //echo (var_dump($_POST));
//          $crud = new Crud();
//          $insert = $crud->insertUjTura($_POST);
//     }
?> -->

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
include_once 'templates/nav.php';
?>
<a href="admin.php">Vissza</a>
<div class="div-newTour">
    <form method="post" action="hozzaad.php" enctype="multipart/form-data" class="newTour">
        <label for="turaNev">Túra neve</label>
        <input type="text" name="turaNev">
        <label for="turaTipus">Túra típusa</label>
        <select name="turaTipus">
            <option value="1">vízitúra</option>
            <option value="2">gyalogos</option>
            <option value="3">kerékpár</option>
        </select>
        <label for="turaSzint">Túra szint</label>
        <select name="turaSzint">
            <option value="1" name="1">könnyű</option>
            <option value="2" name="2">közepes</option>
            <option value="3" name="3">nehéz</option>
        </select>
        <label for="leiras">Leírás</label>
        <textarea  name="leiras" ></textarea>
        <label for="kepFile">Kép kiválasztása</label>
        <input type="file" name="kepFile">
        <label for="kepCim">Kép cím (alt tag)</label>
        <input type="text" name="kepCim">
        <label for="lokacio">Lokáció</label>
        <select name="lokacio">
            <option value="1" name="1">Balaton-felvidék</option>
            <option value="2" name="2">Balaton</option>
            <option value="3" name="3">Kis-Balaton</option>
            <option value="4" name="4">Mecsek-Villány-Zselic</option>
            <option value="5" name="5">Mezőföld és Dunamente</option>
        </select>
        <label for="cimke">Cimkék</label>
        <select name="cimke[]" multiple size="6">
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
        </select>
        <label for="teljesitesIdo">Teljesítési idő (óra)</label>
        <input type="number" name="teljesitesIdo" min="1" max="50">
        <label for="turaHossz">Túra hossz (km)</label>
        <input type="number" name="turaHossz" min="1" max="100">

        
        <input type="submit" value="hozzáad" name="submit">
    </form>
</div>
</body>
</html>
