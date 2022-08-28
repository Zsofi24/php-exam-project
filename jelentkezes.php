<?php
session_start();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelentkezés</title>
    <script src="https://kit.fontawesome.com/bee62954a8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<?php
require_once ('templates/nav.php');
require_once('includes/jelentkezes.inc.php');
?>

<?php if($status==="success"): ?>
  <h1>Sikeres jelenkezés</h1> 
<?php elseif($status === "validationerror"): ?>
  <h1>Sikertelen jelentkezés</h1>
  <p>*Kérem, helyes adatokat adjon meg!</p>
<?php elseif($status === "loginerror"): ?>
  <h1>Sikertelen jelentkezés</h1>
  <p>*A jelentkezés elküldéséhez, kérem <a href="login.php" >Jelentkezzen be</a>. Ha nincs még felhasználói fiókja, akkor <a href="signup.php">Regisztráljon!</a></p>
<?php endif ?>

<div class="form-jelentkezes">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="vezeteknev">vezetéknév</label>
    <input type="text" placeholder="vezetéknév" name="vezeteknev" id="vezeteknev" value="<?= $_POST['vezeteknev'] ?? ''?>">
    <div class="error">
        <?php echo $errors['vezeteknev'] ?? '' ?>
    </div>
    <label for="keresztnev">keresztnév</label>
    <input type="text" placeholder="keresztnév" name="keresztnev" id="keresztnev" value="<?= $_POST['keresztnev'] ?? ''?>">
    <div class="error">
        <?php echo $errors['keresztnev'] ?? '' ?>
      </div>
    <label for="email">e-mail cím</label>
    <input type="email" placeholder="e-mail cím" id="email" name="email" value="<?= $_POST['email'] ?? ''?>">
    <div class="error">
        <?php echo $errors['email'] ?? '' ?>
      </div>
    <label for="telefon">telefonszám</label>
    <input type="text" placeholder="06301234567" id="telefon" name="telefon" value="<?= $_POST['telefon'] ?? ''?>">
    <div class="error">
        <?php echo $errors['telefon'] ?? '' ?>
      </div>
    <label for="tura">túra</label>
    <select id="tura" name="tura">
        <?php foreach ($nev as $value): ?>
          <?php $attrib = $_GET['id'] == $value[0] ? "selected" : "" ?>
          <option <?php echo $attrib ?> value="<?php echo $value[0] ?>"><?php echo $value[1] ?></option>
          
        <?php endforeach ?>
    </select>
    <!-- <label for="idopont">Időpont</label>
    <select id="idopont" name="idopont">
        <option value="">1</option>
        <option value="#">2</option>
        <option value="#">3</option>
        <option value="#">4</option>
    </select> -->
    <label for="fo">létszám</label>
    <input type="number" placeholder="jelentkezők létszáma" id="fo" name="fo" min="1" max="40" value="<?= $_POST['fo'] ?? ''?>">
    <div class="error">
        <?php echo $errors['fo'] ?? '' ?>
    </div>
    <input type="submit" value="jelentkezés" id="submit" name="submit">
</form>

<div class="form-image">
</div>

</div>

<?php
include_once 'templates/footer.php';
?>
