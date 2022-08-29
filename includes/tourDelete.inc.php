<?php

$status = "";

if(isset($_POST['delete'])) {

    $id = $_POST['id'];
    require_once('sql/DB.php');
    require_once('classes/tourDelete.classes.php');
    $tourDelete = new TourDelete();
    $delete = $tourDelete->deleteData($id);
    
    header('Location: admin.php');
}
