<?php
/* require '../pdo_connect.php';
require 'get_functions.php';
$pdo = pdo_connect(); */

require 'get.php';
$data = [
	"username"=>"max",
	"name"=>"cuniferous"
];
var_dump( get_traits($data) );