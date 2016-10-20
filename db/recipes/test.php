<?php
require 'recipes.php';
$recipe = [
	"title"=>"name20",
	"ingredients"=>"list",
	"instructions"=>"more list",
	"published"=>"0",
	"user_id"=>1
];
var_dump( create_recipe($recipe) );