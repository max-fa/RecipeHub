<?php
//require '../pdo_connect.php';
require 'update.php';
$pdo = pdo_connect();

$updates = [
	"published"=>"TRUE",
	"likes"=>99
];

var_dump( update_recipe( 3,$updates,1 ) );
