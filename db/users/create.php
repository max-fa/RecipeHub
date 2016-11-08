<?php
require '../db/pdo_connect.php';

function create_user($data) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("INSERT INTO users (username,password) VALUES(:username,:password)");
			$statement->bindValue(":username",$data["username"]);
			$statement->bindValue( ":password", password_hash( $data["password"],PASSWORD_DEFAULT ) );
			
			if( $statement->execute() ) {
				
				return [true];
				
			} else {
				
				return [false,"Could not create user"];
				
			}			
			
		} catch( PDOException $e ) {
			
			return [false,"Database error"];
			
		}

	} else {
		
		return [false,"Could not connect to database"];
		
	}
	
}