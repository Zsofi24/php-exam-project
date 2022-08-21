<?php

$status = "";

if(isset($_POST["adminsubmit"])) {

    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    
    include "classes/dbh.classes.php";    
    include "classes/adminLogin.classes.php";
    include "classes/adminLogin-contr.classes.php";
    $login = new LoginContr($uid, $pwd);

    $errors = $login->errors();
    
    if(empty($errors)) {
        header('Location: admin.php');
    } else {
        $status = 'loginerror';
    }

    
}
