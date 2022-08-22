<?php
require_once('sql/DB.php');
require_once('classes/jelentkezes.classes.php');
require_once('classes/jelentkezessql.classes.php');

$sql = new JelentkezesSql();
$nev = $sql->selectNev();

$errors = [];
$status = "";

if(isset($_POST['submit'])){

  if(empty($_SESSION)) {
    $status = 'loginerror';
  } else {
    $validation = new JelentkezesValidator($_POST);
    $errors = $validation->validateForm();
      
    if(empty($errors)) {
      $date = date('m/d/Y h:i:s', time());
      $insert = $sql->insertJelentkezes($_POST, $date);
      $status = 'success';
    } else {
      $status = 'validationerror';
    }
  }
    
}
