<?php
require_once('sql/DB.php');
require_once('classes/crud.classes.php');
    if(isset($_POST["submit"])
             && isset($_FILES["kepFile"]) 
            && $_FILES["kepFile"]["error"]== 0) {
                

                if(copy($_FILES["kepFile"]["tmp_name"], 'img/'.$_FILES['kepFile']['name'])) {
       
                    $crud = new Crud();
                    $_POST['kepNev'] = $_FILES['kepFile']['name'];
                    $insert = $crud->insertUjTura($_POST);
                    echo "siker";
                }
        }
    
?>