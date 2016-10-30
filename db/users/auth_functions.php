<?php

function check_credentials($credentials,$user) {
	
	if( password_verify($credentials["password"],$user["password"]) ) {
		
		return [true];
		
	} else {
		
		return [false,"Passwords don't match."];
		
	}
	
}