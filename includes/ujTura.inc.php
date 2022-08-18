<?php
require_once 'sql/DB.php';
require_once 'classes/ujTura.classes.php';

$data = new ujTura();
if($data->getConnect()) {

    $lokacio = $data->selectLokaciok();
    $szint = $data->selectSzintek();
    $tipus = $data->selectTipusok();
    $cimke = $data->selectCimkek();

}
