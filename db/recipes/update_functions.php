<?php

function build_query($updates,$pdo) {
	
	$statement = "UPDATE recipes SET (";
	end($updates);
	$last = key($updates);
	
	foreach( $updates as $column=>$value ) {
		
		if( $column === $last ) {
			
			$statement .= $column . ")";
			
		} else {
			
			$statement .= $column . ",";
			
		}
		
	}
	
	$statement .= " = (";
	
	foreach( $updates as $column=>$value ) {
		
		if( $column === $last ) {
			
			$statement .= ":" . $column . ")";
			
		} else {
			
			$statement .= ":" . $column . ",";
			
		}
		
	}
	
	$statement .= " WHERE id = :id";
	
	return $statement;
	
}

function bindValues($updates,$id,&$statement) {
	
	foreach( $updates as $column=>$value  ) {
		
		$statement->bindValue( ":" . $column,$value );
		
	}
	
	$statement->bindValue(":id",$id);
	
}

function recipe_exists($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
	$statement->bindValue(":id",$id);
	$result = $statement->execute();
	
	if( $result === true ) {
		
		if( $statement->fetch() ) {
			
			return true;
			
		} else {
			
			return false;
			
		}
		
		
	} else {
		
		return false;
		
	}
	
}



function user_owns_recipe($id,$user_id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
	$statement->bindValue(":id",$id);
	$recipe;
	
	if( $statement->execute() ) {
		
		$recipe = $statement->fetch();
		
		if( $recipe ) {
			
			if( $recipe["user_id"] === $user_id ) {
				
				return true;
				
			} else {
				
				return false;
				
			}
			
		}
		
	} else {
		
		echo "Statement failed";
		return false;
		
	}
	
}