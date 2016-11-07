<?php
require '../db/pdo_connect.php';

function recipes_get_all() {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("SELECT * FROM recipes ORDER BY id");
		
		if( $statement->execute() ) {
			
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
		} else {
			
			echo "Could not fetch recipes";
			return false;
			
		}
		
	} else {
		
		return [false,"Could not connect to database"];
		
	}
	
}



function recipes_get_one($id) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
			$statement = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
			$statement->bindValue(":id",$id);
			
			if( $statement->execute() ) {
				
				return $statement->fetch(PDO::FETCH_ASSOC);
				
			} else {
				
				echo "Could not get recipe";
				return false;
				
			}
		
	} else {
		
		return [false,"Could not connect to database"];
		
	}
	
}