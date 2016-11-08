<?php
require '../db/pdo_connect.php';

function delete_user($username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("DELETE FROM users WHERE username = :username");
			$statement->bindValue(":username",$username);
			
			if( $statement->execute() ) {
				
				return [true];
				
			} else {
				
				return [false,"Could not delete user"];
				
			}			
			
		} catch( PDOException $e ) {
			
			return [false,"Database error"];
			
		}
		
	} else {
		
		return [false,"Could not connect to database"];
		
	}
	
}