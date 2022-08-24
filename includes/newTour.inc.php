<?php
require_once('sql/DB.php');
require_once('classes/crud.classes.php');
require_once ('classes/newTour.classes.php');
require_once ('classes/newTour-contr.classes.php');


$data = new NewTour();
if($data->getConnect()) {

    $lokacio = $data->selectLokaciok();
    $szint = $data->selectSzintek();
    $tipus = $data->selectTipusok();
    $cimke = $data->selectCimkek();

}

$status = "";

if(isset($_POST["submit"])) {
    if (isset($_FILES["kepFile"]) 
    && $_FILES["kepFile"]["error"]== 0) {

        $name = $_POST['turaNev'];
        $text = $_POST['leiras'];
        $imgName = $_POST['kepCim'];
        $hours = $_POST['teljesitesIdo'];
        $length = $_POST['turaHossz'];
        if(isset($_POST['cimke'])) {
            $label = $_POST['cimke'];
        } else {
            $label = "";
        }
        $type = $_POST['turaTipus'];
        $level = $_POST['turaSzint'];
        $location = $_POST['lokacio'];
        
                   
        if(copy($_FILES["kepFile"]["tmp_name"], 'img/'.$_FILES['kepFile']['name'])) {
            $newTourContr = new NewTourContr($name, $text, $imgName, $hours, $length, $label, $type, $level, $location);
            $errors = $newTourContr->errors();
        
            if (empty($errors)) {
               $status = "success";
               
                $kepNev = $_FILES['kepFile']['name'];
                $insert = $data->insertNewTour($text, $kepNev, $imgName, $name, $hours, $length, $location, $level, $type, $label);
        
                header('Location: admin.php');
            } else {
                $status = "inserterror";
            }
        }
    } else {
        $status = "emptyimg";
    }
}  
