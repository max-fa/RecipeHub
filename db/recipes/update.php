<?php
require '../pdo_connect.php';
require 'update_functions.php';

function update_recipe($id,$updates,$user_id) {
	
	$pdo = pdo_connect();
	$statement;
	$recipe_exists;
	$user_is_owner;
	
	if( $pdo ) {
		
		$recipe_exists = recipe_exists($id,$pdo);
		
		if( $recipe_exists ) {
			
			$user_is_owner = user_owns_recipe($id,$user_id,$pdo);
			
			if( $user_is_owner ) {
				
				$statement = $pdo->prepare( build_query($updates,$pdo) );
				
				bindValues($updates,$id,$statement);
				
				if( $statement->execute() ) {
					
					return true;
					
				} else {
					
					echo "Could not update";
					return false;
					
				}
				
			} else {
				
				echo "This ain't yours!";
				return false;
				
			}
			
		} else {
			
			echo "That recipe doesn't exist";
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}