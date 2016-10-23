<?php
require '../pdo_connect.php';
require 'common_functions.php';

function delete_recipe($id,$user_id) {
	
	$pdo = pdo_connect();
	$recipe_exists = recipe_exists($id,$pdo);
	$statement;
	$user_is_owner;
	if( $pdo ) {
		
		if( $recipe_exists ) {
			
			$user_is_owner = user_owns_recipe($id,$user_id,$pdo);
			
			if( $user_is_owner ) {
				
				$statement = $pdo->prepare("DELETE FROM recipes WHERE id = :id");
				$statement->bindValue(":id",$id);
				
				if( $statement->execute() ) {
					
					return true;
					
				} else {
					
					echo "Could not delete the recipe";
					return false;
					
				}
				
				
			} else {
				
				echo "We cannot delete";
				return false;
				
			}
			
		} else {
			
			echo "Recipe doesn't exist";
			return false;
			
		}		
		
	} else {
		
		echo "Could not connect to the database";
		return false;
		
	}

	
}