<?php
require '../db/pdo_connect.php';

function delete_trait($id,$username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare("DELETE FROM traits WHERE id = :id");
			$statement->bindValue(":id",$id);
			
			if( $statement->execute() ) {
				
				return [true];
				
			} else {
				
				return [false,"Could not delete trait"];
				
			}			
			
		} catch( PDOException $e ) {
			
			return [false,"Database error"];
			
		}
		
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}

	
}