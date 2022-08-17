<?php

$status = "";

if(isset($_POST["adminsubmit"])) {

    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    
    include "classes/dbh.classes.php";    
    include "classes/login.classes.php";
    include "classes/login-contr.classes.php";
    $login = new LoginContr($uid, $pwd);

    $errors = $login->errors();
    
    if(empty($errors)) {
        header('Location: admin.php');
    } else {
        $status = 'loginerror';
    }

    
}
