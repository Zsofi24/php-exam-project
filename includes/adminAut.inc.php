<?php

require_once('sql/DB.php');
require_once('classes/admindAut.classes.php');
$adminAut = new AdminAut();
$admin = $adminAut->selectAdmin();
foreach ($admin as $value) {
    if($_SESSION['useruid'] !== $value) {
        header('Location: index.php');
    }
}
