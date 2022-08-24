<?php

require_once ('sql/DB.php');
require_once ('classes/tours.classes.php');

$tura = new Tura();
if($tura->getConnect()) {

    $locations = $tura->selectLocations();
    
    foreach ($locations as $key => $value) {
        $id = $locations[$key]['helyszinId'];
        $box[] = $tura->selectBoxLocation($id);
        foreach ($box[$key] as $keyy => $valuee) {
            $leiras[$key][$keyy] = $tura->cut($box[$key][$keyy]['leiras'], 200);
        }
    }
}
