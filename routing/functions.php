<?php

function find_route($array,$key,$value) {

	foreach( $array as $index=>$route ) {
		
		if( $route[$key] === $value ) {
			
			return $index;
			
		}
		
	}
	
	return false;
	
}