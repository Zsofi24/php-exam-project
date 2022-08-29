<?php
require_once('sql/DB.php');
require_once('classes/tourInfo.classes.php');

$db = new TourInfo();
if($db->getConnect()) {

    $nev = $db->selectName($_GET['id']);
    $leiras = $db->selectDescr($_GET['id']);
    $kep = $db->selectImg($_GET['id']);
    $lokacio = $db->selectLocation($_GET['id']);
    $cimke = $db->selectLabel($_GET['id']);
    $idohossz = $db->selectTimeLength($_GET['id']);
    $szinttipus = $db->selectLevelType($_GET['id']);

}
