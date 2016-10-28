<?php

require 'update.php';

$data = [
	"name"=>"chicken"
];

var_dump( update_fooditem(2,$data,'admin') );