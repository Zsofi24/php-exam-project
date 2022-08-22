<?php
session_start();
require_once('includes/adminAut.inc.php');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="https://kit.fontawesome.com/bee62954a8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
</head>
<body>
<!-- <div id="editor">This is some sample content.</div>
                <script>
                        ClassicEditor
                                .create( document.querySelector( '#editor' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script> -->
<?php

require_once('templates/nav.php');
require_once('sql/DB.php');
require_once('classes/crud.classes.php');
$crud = new Crud();
$header = $crud->getHeader();
$tableData = $crud->selectCrudData();

?> 
   
<div class="addButton">
        <button><a href="ujTura.php">Új hozzáadása</a>
        </button>
</div>
<table class="crud-table">
        <thead>
                <tr>
                <?php
                foreach ($header as $value): ?>
                        <th><?php echo ($value); ?></th>
                <?php endforeach ?>
                        <th>Műveletek</th>
                </tr>
        </thead>
        <tbody>
                <?php
                for ($i=0; $i < count($tableData) ; $i++):
                        if (count($tableData[$i]) == count($header)) {
                                $leiras = $tableData[$i]['leiras'];
                                $tableData[$i]['leiras'] = $crud->cut($leiras, 100);
                ?>
                        <tr>
                        <?php
                        foreach ($tableData[$i] as $key => $value): ?>
                                <td><?php echo $value; ?> </td>
                        <?php endforeach ?>
                                <td colspan="2">
                                        <a href="turaEdit.php?id=<?php echo $tableData[$i]['id']?>">Szerkeszt</a>
                                        <a href="turaDelete.php?id=<?php echo $tableData[$i]['id']?>">Töröl</a>
                                </td>
                        </tr>

                <?php
                        } else {
                ?>
                                <p>Rossz adatok</p>
                <?php
                        } 
                        endfor
                ?>
        </tbody>
</table>  
</body>
</html>
