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



function valid_get_from_user_request($request,$pdo) {
	
	if( isset($request["user_id"]) ) {
		
		if( (int)$request["user_id"] !== 0 ) {
			
			if( user_exists((int)$request["user_id"],$pdo)[0] === true ) {
				
				return [true];
				
			} else {
				
				return [false,"User doesn't exists"];
				
			}
			
		} else {
			
			return [false,"Illegal user id"];
			
		}
		
	} else {
		
		return [false,"Must provide a user id."];
		
	}
	
}



function valid_get_many_request($request,$pdo) {
	
	if( isset($request["limit"]) ) {
		
		if( (int)$request["limit"] > 0 || $request["limit"] === "*" ) {
			
			return [true];
			
		} else {
			
			return [false,"Illegal limit parameter"];
			
		}
		
	} else {
		
		return [false,"Must provide a limit"];
		
	}
	
}



function convert_query_string($request,$keys) {
	
		foreach( $keys as $key ) {
			
			if( $request[$key] !== "*" ) {
				
				$request[$key] = (int)$request[$key];
				
			}
		}
	
	return $request;
	
}



function strip_params($request,$whitelist) {
	
	foreach( $request as $key=>$val ) {
		
		if( !in_array($key,$whitelist,true) ) {
			
			unset($request[$key]);
			
		}
		
	}
	
	return $request;
	
}