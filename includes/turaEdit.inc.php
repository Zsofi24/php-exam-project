<?php

require_once('../sql/DB.php');
require_once('../classes/turaEdit.classes.php');

if(isset($_POST['edit']))
{
    $id = $_POST['getid'];
    $turaEdit = new turaEdit();
    $_POST['kepNev'] = $_FILES['kepFile']['name'];
    $update = $turaEdit->updateTura($_POST, $id);
    
    echo "siker";


} else {
    echo "nem";
}