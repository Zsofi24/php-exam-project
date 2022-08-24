<?php

$status = "";

if(isset($_POST['delete'])) {

    $id = $_POST['id'];
    require_once('sql/DB.php');
    require_once('classes/tourDelete.classes.php');
    $tourDelete = new tourDelete();
    $delete = $tourDelete->deleteData($id);
    
    header('Location: admin.php');
}
