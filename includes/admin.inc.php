<?php

require_once('sql/DB.php');
require_once('classes/crud.classes.php');
$crud = new Crud();
$header = $crud->getHeader();
$tableData = $crud->selectCrudData();
