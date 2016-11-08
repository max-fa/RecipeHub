<?php
require '../db/pdo_connect.php';

function delete_recipe($id) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("DELETE FROM recipes WHERE id = :id");
			$statement->bindValue(":id",$id);
			
			if( $statement->execute() ) {
				
				return [true];
				
			} else {
				
				return [false,"Could not the delete recipe"];
				
			}
			
		} catch( PDOException $e ) {
			
			return [false,"Database error"];
			
		}
				
		
	} else {
		
		return [false,"Could not connect to database"]
		
	}

	
}