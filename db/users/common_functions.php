<?php

function user_exists($username,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
	$statement->bindValue(":username",$username);
	
	if( $statement->execute() ) {
		
		if( $statement->fetch() ) {
			
			return true;
			
		} else {
			
			return false;
			
		}		
		
	} else {
		
		return false;
		
	}
	
}