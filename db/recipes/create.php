<?php
require '../db/pdo_connect.php';


function create_recipe($recipe) {
	
	$pdo = pdo_connect();
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("INSERT INTO recipes (title,ingredients,instructions,published,user_id) VALUES(:title,:ingredients,:instructions,:published,:user_id)");
			$statement->bindValue(":title",$recipe["title"]);
			$statement->bindValue(":ingredients",$recipe["ingredients"]);
			$statement->bindValue(":instructions",$recipe["instructions"]);
			$statement->bindValue(":published",$recipe["published"]);
			$statement->bindValue(":user_id",$recipe["user_id"]);
			
			if( $statement->execute() ) {
				
				return [true];
				
			} else {
				
				return [false,"Could not create recipe"];
				
			}
			
		} catch( PDOException $e ) {
			
			return [false,"Database error"];
			
		}
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}