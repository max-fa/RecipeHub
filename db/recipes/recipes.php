<?php
require '../pdo_connect.php';
require 'validate.php';

function create_recipe($recipe) {
	
	$pdo = pdo_connect();
	$valid_recipe = validate_recipe($recipe);
	$insert;
	$statement = $pdo->prepare("INSERT INTO recipes (title,ingredients,instructions,published,user_id) VALUES(:title,:ingredients,:instructions,:published,:user_id)");
	$statement->bindValue(":title",$recipe["title"]);
	$statement->bindValue(":ingredients",$recipe["ingredients"]);
	$statement->bindValue(":instructions",$recipe["instructions"]);
	$statement->bindValue(":published",$recipe["published"]);
	$statement->bindValue(":user_id",$recipe["user_id"]);
	
	if( $valid_recipe[0] === true ) {
		
		$insert = $statement->execute();
		
		if( $insert !== false ) {
			
			return true;
			
		} else {
			
			echo $statement->errorCode();
			echo $statement->errorInfo()[2];
			return false;
			
		}			
		
	} else {
		
		echo $valid_recipe[1];
		return false;
		
	}

	
}







