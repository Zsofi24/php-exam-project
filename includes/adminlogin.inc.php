<?php

$status = "";

require_once('sql/DB.php');
require_once('classes/admindAut.classes.php');
$adminAut = new AdminAut();
$admin = $adminAut->selectAdmin();
if(isset($_SESSION['useruid'])) {
    foreach ($admin as $value) {
        if($_SESSION['useruid'] === $value) {
            header('Location: admin.php');
        } 
    }
}

if(isset($_POST["adminsubmit"])) {

    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
        
    require_once('classes/dbh.classes.php');    
    require_once('classes/adminLogin.classes.php');
    require_once('classes/adminLogin-contr.classes.php');
    $login = new LoginContr($uid, $pwd);
        
    $errors = $login->errors();
        
    if(empty($errors)) {
        header('Location: admin.php');
    } else {
        $status = 'loginerror';
    }
}
