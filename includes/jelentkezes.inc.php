<?php
require_once('sql/DB.php');
require_once('classes/jelentkezes.classes.php');
require_once('classes/jelentkezessql.classes.php');

$sql = new JelentkezesSql();
$nev = $sql->selectNev();

$errors = [];
$status = "";

if(isset($_POST['submit'])){

  $validation = new JelentkezesValidator($_POST);
  $errors = $validation->validateForm();
    
  if(empty($errors)) {
    $insert = new DB();
    $insert = $insert->insertJelentkezes($_POST);
    $status = 'success';
  } else {
    $status = 'validationerror';
  }
    
}
