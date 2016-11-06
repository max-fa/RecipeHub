<?php
$a = "something/really?done=true/very/long?action=one;tuple=three";

$end_index = strpos($a,"?");
echo substr($a,0,$end_index);
