<?php
require 'common_validators.php';

/* 
	needs a valid user_id and recipe_id
	should also do checks for user exists and recipe exists
	also check if user is owner
*/

function valid_get_one_request($request,$pdo) {
	
	$has_fields = query_has_fields($request,["user_id"=>"integer","recipe_id"=>"integer"]);
	$user_exists;
	$recipe_exists;
	$user_owns_recipe;
	
	if( $has_fields[0] === true ) {
		
		$user_exists = user_exists((int)$request["user_id"],$pdo);
		$recipe_exists = recipe_exists((int)$request["recipe_id"],$pdo);
		$user_owns_recipe = user_owns_recipe( (int)$request["recipe_id"],(int)$request["user_id"],$pdo );
		
		if( $user_exists[0] === true ) {
			
			if( $recipe_exists[0] === true ) {
				
				if( $user_owns_recipe[0] === true ) {
					
					return [true];
					
				} else {
					
					return $user_owns_recipe;
					
				}
				
			} else {
				
				return $recipe_exists;
				
			}
			
		} else {
			
			return $user_exists;
			
		}
		
	} else {
		
		return $has_fields;
		
	}
	
}