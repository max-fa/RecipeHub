<?php
require '../db/pdo_connect.php';

function create_trait($trait_data) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("INSERT INTO traits (name,description,username) VALUES(:name,:description,:username)");
			$statement->bindValue(":name",$trait_data["name"]);
			$statement->bindValue(":description",$trait_data["description"]);
			$statement->bindValue(":username",$trait_data["username"]);
			
			if( $statement->execute() ) {
				
				return [true];
				
			} else {
				
				return [false,"Could not create trait"];
				
			}			
			
		} catch( PDOException $e ) {
			
			return [false,"Database error"];
			
		}

		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}