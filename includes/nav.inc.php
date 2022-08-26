<?php

require_once('sql/DB.php');
require_once('classes/nav.classes.php');

$nav = new Nav();

if($nav->getConnect()) {

    $locations = $nav->selectLocations();

}
