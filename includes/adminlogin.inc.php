<?php

if(isset($_POST["adminsubmit"])) {

    //grabbing the data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    
    //instatiate SignupConr class
    include "../classes/dbh.classes.php";    
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($uid, $pwd);

    //Running error handlers and user signup
    $login->loginUser();

    //going back to front page
    header('Location: ../admin.php');
}
