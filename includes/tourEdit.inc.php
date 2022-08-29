<?php

require_once('sql/DB.php');
require_once('classes/tourEdit.classes.php');

$status = "";
if(isset($_GET['status'])) {

    $status = $_GET['status'];
}
if(isset($_POST['edit']))
{
    $id = $_POST['getid'];
    $tourEdit = new TourEdit();
    $_POST['kepNev'] = $_FILES['kepFile']['name'];
    $result = "success";
    try{
        $update = $tourEdit->updateTour($_POST, $id);
    } catch (Exception $e) {
        $result = "error";
    }
    header("Location: tourEdit.php?id=$id&status=$result");

} 
