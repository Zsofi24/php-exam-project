<?php
require_once "sql/DB.php";

$db = new DB();
if($db->getConnect()) {
   
    $box = $db->selectBox();
   
    foreach ($box as $key => $value) {
        $leiras[] = $db->cut($value['leiras'], 200);
    } 
    
}
