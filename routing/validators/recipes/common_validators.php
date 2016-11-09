<?php
//require '../db/pdo_connect.php';

function recipe_exists($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
	$statement->bindValue(":id",$id);
	$result = $statement->execute();
	
	if( $result === true ) {
		
		if( $statement->fetch() ) {
			
			return [true];
			
		} else {
			
			return [false,"Recipe doesn't exist"];
			
		}
		
		
	} else {
		
		return [false,"Could not determine existence of recipe"];
		
	}
	
}



function user_exists($user_id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
	$statement->bindValue(":id",$user_id);
	$result = $statement->execute();
	
	if( $result === true ) {
		
		if( $statement->fetch() ) {
			
			return [true];
			
		} else {
			
			return [false,"User doesn't exist"];
			
		}
		
		
	} else {
		
		return [false,"Could not determine existance of user"];
		
	}	
	
}



function user_owns_recipe($recipe_id,$user_id,$pdo) {
	
	$statement;
	$recipe;
	
	$statement = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
	$statement->bindValue(":id",$recipe_id);
	
	if( $statement->execute() ) {
		
		$recipe = $statement->fetch(PDO::FETCH_ASSOC);
		
		if( $recipe ) {
			
			if( $recipe["user_id"] === $user_id ) {
				
				return [true];
				
			} else {
				
				return [false,"User is not owner"];
				
			}
			
		}
		
	} else {
		
		return [false,"Could not verify ownership of recipe"];
		
	}
	
}



/* this version of has_fields() is made to work with query parameters
which are a bit tricky since they are strings,so you need to applly some rules about 
what you evaluate as a valid integer */

function query_has_fields($request,$required_fields) {
	
	foreach( $required_fields as $key=>$type ) {
		
		if( isset( $request[$key] ) ) {
			
			switch( $type ) {
				
				case "integer":
					
					if( intval($request[$key]) === 0 ) {
						
						return [false,"Field " . $key . " must be a string that can be explicitly converted to integer"];
						
					}
					
					break;
					
				case "bool":
					
					if( $request[$key] !== "true" || $request[$key] !== "false" ) {
						
						return [false,"Field " . $key . " must be a boolean"];
						
					}
					
					break;
					
				default:
					
					//do nothing
					
					break;
				
			}
			
		} else {
			
			return [false,"Missing key: " . $key];
			
		}
		
	}
	
	return [true];
	
}