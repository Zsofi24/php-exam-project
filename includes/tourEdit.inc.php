<?php

require_once('sql/DB.php');
require_once('classes/tourEdit.classes.php');
$status = "";
if(isset($_POST['edit']))
{
    $id = $_POST['getid'];
    $tourEdit = new tourEdit();
    $_POST['kepNev'] = $_FILES['kepFile']['name'];
    $update = $tourEdit->updateTura($_POST, $id);
    $status = "success";
    header("Location: tourEdit.php?id=$id");

} 