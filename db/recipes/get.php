<?php

function recipes_get($params,$pdo) {
	
	if( isset($params["recipe_id"]) ) {
		
		return recipes_get_one($params["recipe_id"],$pdo);
		
	} else {
		
		return recipes_get_all($pdo);
		
	}
	
}

function recipes_get_all($pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM recipes ORDER BY id");
	
	if( $statement->execute() ) {
		
		return $statement->fetchAll(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}



function recipes_get_one($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		return $statement->fetch(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}