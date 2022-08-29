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
    <title>Új túra hozzáadása</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="https://kit.fontawesome.com/bee62954a8.js" crossorigin="anonymous"></script>
</head>
<body>

<?php
require_once('templates/nav.php');
require_once('includes/newTour.inc.php');
?>

<div class="back-button">
    <button><a href="admin.php"><i class="fa-solid fa-arrow-left-long"> Vissza</i></a></button>
</div>

<?php if($status === 'success'): ?>
    <h1>Sikeresen hozzáadta az új túrát!</h1> 
<?php elseif($status === 'inserterror'): ?>
    <h1>Nem sikerült hozzáadni az új túrát.</h1>
    <p><?php echo $errors['empty'] ?? '' ?></p>
<?php elseif($status === 'emptyimg'): ?>
    <h1>Nem sikerült hozzáadni az új túrát.</h1>
    <p>*Kérem, töltsön fel egy képet.</p>
<?php endif ?>

<div class="div-newTour">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" class="newTour">
        <label for="turaNev">Túra neve</label>
        <input type="text" name="turaNev">
        <div class="error">
            <p><?php echo $errors['name'] ?? '' ?></p>
        </div>

        <label for="turaTipus">Túra típusa</label>
        <select name="turaTipus">
            <?php foreach ($tipus as $key) : ?>
                <option value="<?php echo $key['id'] ?>"><?php echo $key['tipus'] ?></option>
            <?php endforeach ?>
        </select>

        <label for="turaSzint">Túra szint</label>
        <select name="turaSzint">
        <?php foreach ($szint as $key) : ?>
                <option value="<?php echo $key['id'] ?>"><?php echo $key['szint'] ?></option>
            <?php endforeach ?>
        </select>

        <label for="leiras">Leírás</label>
        <textarea  name="leiras" ></textarea>
        

        <label for="kepFile">Kép kiválasztása</label>
        <input type="file" name="kepFile">

        <label for="kepCim">Kép cím (alt tag)</label>
        <input type="text" name="kepCim">
        <div class="error">
                <p><?php echo $errors['imgName'] ?? '' ?></p>
        </div>

        <label for="lokacio">Lokáció</label>
        <select name="lokacio">
        <?php foreach ($lokacio as $key) : ?>
                <option value="<?php echo $key['id'] ?>"><?php echo $key['lokacio'] ?></option>
            <?php endforeach ?>
        </select>

        <label for="cimke">Cimkék</label>
        <?php foreach ($cimke as $key) : ?>
            <label class="label checkbox" for="cimke[]" ><?php echo $key['cimke']?> 
                <input type="checkbox" name="cimke[]" value="<?php echo $key['id'] ?>">
            </label>
        <?php endforeach ?>
        
        <label for="teljesitesIdo">Teljesítési idő (óra)</label>
        <input type="number" name="teljesitesIdo" min="1" max="50">
        <div class="error">
                <p><?php echo $errors['hours'] ?? '' ?></p>
        </div>

        <label for="turaHossz">Túra hossz (km)</label>
        <input type="number" name="turaHossz" min="1" max="100">
        <div class="error">
                <p><?php echo $errors['length'] ?? '' ?></p>
        </div>
        
        <input type="submit" value="hozzáad" name="submit">
    </form>
</div>

<?php
require_once('templates/footer.php');
?>
