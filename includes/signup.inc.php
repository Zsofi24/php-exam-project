<?php

if(isset($_POST["submit"])) {

    //grabbing the data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];

    //instatiate SignupConr class
    include "classes/dbh.classes.php";    
    include "classes/signup.classes.php";
    include "classes/signup-contr.classes.php";
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);

    //Running error handlers and user signup

    $errors = $signup->signupUser();

    //going back to front page
    //header('Location: ../index.php?error=none');
}
