<?php
/* require '../pdo_connect.php';
require 'associate_functions.php';
$pdo = pdo_connect();

var_dump( not_already_associated(1,1,$pdo) ); */

require 'dissociate.php';
var_dump( dissociate_trait(4,4,'max') );