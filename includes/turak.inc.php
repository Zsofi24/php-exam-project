<?php

require_once ('sql/DB.php');
require_once ('classes/turak.classes.php');

$tura = new Tura();
if($tura->getConnect()) {
   
    $box = $tura->selectBox();
   
    foreach ($box as $key => $value) {
        $leiras[] = $tura->cut($value['leiras'], 200);
    } 
    
}
