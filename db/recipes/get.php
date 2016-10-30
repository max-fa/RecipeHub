<?php
require '../pdo_connect.php';
require 'common_functions.php';

function recipes_get_many($params) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		//just get all recipes
		if( $params === null ) {
			
			$statement = $pdo->prepare("SELECT * FROM recipes ORDER BY id");
			
			if( $statement->execute() ) {
				
				return $statement->fetchAll(PDO::FETCH_ASSOC);
				
			} else {
				
				echo "Could not get recipes";
				return false;
				
			}
			
		//get an amount of recipes not exceeding $limit
		} else if( $params["limit"] ) {
			
			$statement = $pdo->prepare("SELECT * FROM recipes ORDER BY id LIMIT :count");
			$statement->bindValue(":count",$params["limit"]);
			
			if( $statement->execute() ) {
				
				return $statement->fetchAll(PDO::FETCH_ASSOC);
				
			} else {
				
				echo "Could not get recipes";
				return false;
				
			}
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}



function recipes_get_one($id) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		if( recipe_exists($id,$pdo) ) {
			
			$statement = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
			$statement->bindValue(":id",$id);
			
			if( $statement->execute() ) {
				
				return $statement->fetch(PDO::FETCH_ASSOC);
				
			} else {
				
				echo "Could not get recipe";
				return false;
				
			}
			
		} else {
			
			echo "Recipe doesn't exist";
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}