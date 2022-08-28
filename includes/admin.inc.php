<?php

require_once('sql/DB.php');
require_once('classes/crud.classes.php');
$crud = new Crud();
$header = $crud->getHeader();
$dataCount = $crud->dataCount();

if(isset($_GET['p'])){
    $page = (int)$_GET['p'];
    $tableData = $crud->pageData($page);
    $pagecount = $crud->pager($page, $dataCount, $countperpage=8);
}else{
    $page = 1;
    $tableData = $crud->pageData(1);
    $pagecount = $crud->pager(1, $dataCount, $countperpage=8);
}
