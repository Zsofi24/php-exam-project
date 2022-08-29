<?php
require_once('sql/DB.php');
require_once('classes/apply-validator.classes.php');
require_once('classes/applySql.classes.php');

$sql = new ApplySql();
$nev = $sql->selectName();

$errors = [];
$status = "";

if(isset($_POST['submit'])){

  if(empty($_SESSION)) {
    $status = 'loginerror';
  } else {
    $validation = new ApplyValidator($_POST);
    $errors = $validation->validateForm();
      
    if(empty($errors)) {
      $date = date("Y-m-d H:i:s");
      $insert = $sql->insertApply($_POST, $date);
      $status = 'success';
    } else {
      $status = 'validationerror';
    }
  }
    
}
