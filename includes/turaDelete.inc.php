<?php

$status = "";

if(isset($_POST['delete'])) {

    $id = $_POST['id'];
    require_once('sql/DB.php');
    require_once('classes/turaDelete.classes.php');
    $turaDelete = new turaDelete();
    $delete = $turaDelete->deleteData($id);
    
    header('Location: admin.php');
}
