<?php

$status = "";

if(isset($_POST["submit"])) {

    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    
    require_once('classes/dbh.classes.php');    
    require_once('classes/login.classes.php');
    require_once('classes/login-contr.classes.php');
    $login = new LoginContr($uid, $pwd);

    $errors = $login->errors();
    
    if(empty($errors)) {
        $status = 'success';
    } else {
        $status = 'loginerror';
    }
    
}
