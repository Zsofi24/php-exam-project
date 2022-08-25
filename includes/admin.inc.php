<?php

require_once('sql/DB.php');
require_once('classes/crud.classes.php');
$crud = new Crud();
$header = $crud->getHeader();
$dataCount = $crud->dataCount();

if(isset($_GET['p'])){
    $page = (int)$_GET['p'];
    $tableData = $crud->pageData($page);
    $pager = $crud->pager($page, $dataCount, $countperpage=8);
}else{
    $tableData = $crud->pageData(1);
    $pager = $crud->pager($page, $dataCount, $countperpage=8);
}
