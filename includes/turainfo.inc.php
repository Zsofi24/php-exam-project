<?php
require_once 'sql/DB.php';
require_once 'classes/turainfo.classes.php';


$db = new TuraInfo();
if($db->getConnect()) {
    $nev = $db->selectNev($_GET['id']);
    $kep = $db->selectKep($_GET['id']);
}
