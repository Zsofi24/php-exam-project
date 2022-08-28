<?php

$status = "";

if(isset($_POST["submit"])) {

    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];
    $date = date("Y-m-d H:i:s");

    require_once('classes/dbh.classes.php');    
    require_once('classes/signup.classes.php');
    require_once('classes/signup-contr.classes.php');

    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email, $date);

    $errors = $signup->errors();
    
    if(empty($errors)) {
      $signup = $signup->signupUser();
      $status = 'success';
    } else {
      $status = 'signuperror';
    }

}
