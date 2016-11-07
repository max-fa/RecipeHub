<?php

function recipes_validate_values($recipe) {
	
	if( !( strlen($recipe["title"]) <= 75 ) ) {
		
		return [false,"Title too long"];
		
	}
	
	if( !( strlen($recipe["ingredients"]) <= 500 ) ) {
		
		return [false,"Ingredients too long"];
		
	}
	
	if( !( strlen($recipe["instructions"]) <= 1000 ) ) {
		
		return [false,"Instructions too long"];
		
	}
	
	if( $recipe["published"] !== "TRUE" && $recipe["published"] !== "FALSE"  ) {
		
		return [false,"Published is not TRUE or FALSE"];
		
	}
	
	return [true];
	
}



function is_of_type($type,$var) {
	
	return gettype($var) === $type;
	
}



function recipes_correct_types($recipe) {
	
	if( !is_of_type("string",$recipe["title"]) ) {
		
		return [false,"Wrong type for title"];
		
	}
	
	if( !is_of_type("string",$recipe["ingredients"]) ) {
		
		return [false,"Wrong type for ingredients"];
		
	}
	
	if( !is_of_type("string",$recipe["instructions"]) ) {
		
		return [false,"Wrong type for instructions"];
		
	}
	
	if( !is_of_type("string",$recipe["published"]) ) {
		
		return [false,"Wrong type for published"];
		
	}
	
	if( !is_of_type("integer",$recipe["user_id"]) ) {
		
		return [false,"Wrong type for user_id"];
		
	}
	
	return [true];
	
}



function recipes_has_fields($recipe) {
	
	if( array_key_exists("title",$recipe) ) {
		
		if( array_key_exists("ingredients",$recipe) ) {
			
			if( array_key_exists("instructions",$recipe) ) {
				
				if( array_key_exists("published",$recipe) ) {
					
					if( array_key_exists("user_id",$recipe) ) {
						
						return [true];
						
					} else {
						
						return [false,"Missing user_id."];
						
					}
					
				} else {
					
					return [false,"Missing published status."];
					
				}
				
			} else {
				
				return [false,"Missing instructions."];
				
			}
			
		} else {
			
			return [false,"Missing ingredients."];
			
		}
		
	} else {
		
		return [false,"Missing title."];
		
	}
	
}

function validate_recipe($recipe) {
	
	$recipes_has_fields = recipes_has_fields($recipe);
	$recipes_correct_types;
	$valid_values;
	
	if( $recipes_has_fields[0] === true ) {
		
		$recipes_correct_types = recipes_correct_types($recipe);
		
		
		if( $recipes_correct_types[0] === true ) {
			
			$valid_values = recipes_validate_values($recipe);
			
			if( $valid_values[0] ) {
				
				return [true];
				
			} else {
				
				return $valid_values;
				
			}
			
		} else {
		
			return $recipes_correct_types;
			
		}
		
	} else {
		
		return $recipes_has_fields;
		
	}
	
}