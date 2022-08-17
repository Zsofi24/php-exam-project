<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
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
require_once('includes/jelentkezes.inc.php');
?>

<?php if($status==="success"): ?>
  <h1>Sikeres jelenkezés</h1> 
<?php elseif($status === "validationerror"): ?>
  <h1>Sikertelen jelentkezés</h1>
  <p>*Kérem, helyes adatokat adjon meg!</p>
<?php endif ?>

<div class="form-jelentkezes">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="vezeteknev">Vezetéknév</label>
    <input type="text" name="vezeteknev" id="vezeteknev" value="<?= $_POST['vezeteknev'] ?? ''?>">
    <div class="error">
        <?php echo $errors['vezeteknev'] ?? '' ?>
    </div>
    <label for="keresztnev">Keresztnév</label>
    <input type="text" name="keresztnev" id="keresztnev" value="<?= $_POST['keresztnev'] ?? ''?>">
    <div class="error">
        <?php echo $errors['keresztnev'] ?? '' ?>
      </div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= $_POST['email'] ?? ''?>">
    <div class="error">
        <?php echo $errors['email'] ?? '' ?>
      </div>
    <label for="telefon">Telefonszám</label>
    <input type="text" id="telefon" name="telefon" value="<?= $_POST['telefon'] ?? ''?>">
    <div class="error">
        <?php echo $errors['telefon'] ?? '' ?>
      </div>
    <label for="tura">Túra</label>
    <select id="tura" name="tura">
        <?php foreach ($nev as $value): ?>
          <option value="<?php echo $value ?>"><?php echo $value ?></option>
        <?php endforeach ?>
    </select>
    <label for="idopont">Időpont</label>
    <select id="idopont" name="idopont">
        <option value="#">1</option>
        <option value="#">2</option>
        <option value="#">3</option>
        <option value="#">4</option>
    </select>
    <label for="fo">Fő</label>
    <input type="number" id="fo" name="fo" min="1" max="40" value="<?= $_POST['fo'] ?? ''?>">
    <div class="error">
        <?php echo $errors['fo'] ?? '' ?>
      </div>
    <input type="submit" value="jelentkezes" id="submit" name="submit">
</form>

<div class="form-image">
</div>

</div>

<?php
include_once 'templates/footer.php';
?>
