<?php
require 'delete.php';
//require '../pdo_connect.php';
$pdo = pdo_connect();
var_dump( delete_recipe(1,1) );

