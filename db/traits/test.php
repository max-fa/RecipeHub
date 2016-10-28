<?php
/* require '../pdo_connect.php';
require 'update_functions.php';
$pdo = pdo_connect();
$data = [
	"id"=>1,
	"username"=>"madmax"
];
remove_invalid_fields($data);
var_dump($data); */

require 'update.php';
$data = [
	"id"=>600,
	"description"=>"something absolutely newtoniansyian"
];
var_dump( update_trait(3,$data,"max") );