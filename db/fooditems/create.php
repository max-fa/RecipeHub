<?php
require '../db/pdo_connect.php';

function create_fooditem($fooditem_data) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("INSERT INTO fooditems (name,description,username) VALUES(:name,:description,:username)");
			$statement->bindValue(":name",$fooditem_data["name"]);
			$statement->bindValue(":description",$fooditem_data["description"]);
			$statement->bindValue(":username",$fooditem_data["username"]);
			
			if( $statement->execute() ) {
				
				return [true];
				
			} else {
				
				return [false,"Could not create fooditem."];
				
			}
			
		} catch( PDOException $e ) {
			
			return [false,"Database error"];
			
		}
		
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}