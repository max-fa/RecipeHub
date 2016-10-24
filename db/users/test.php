<?php
/* require '../pdo_connect.php';
$pdo = pdo_connect();
require 'common_functions.php'; */

$credentials = [
	"username"=>"admins",
	"password"=>"login"
];

require 'auth.php';

var_dump( authenticate($credentials) );
