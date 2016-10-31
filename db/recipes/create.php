<?php
require '../pdo_connect.php';
require 'create_functions.php';


function create_recipe($recipe) {
	
	$pdo = pdo_connect();
	$insert;
	$statement = $pdo->prepare("INSERT INTO recipes (title,ingredients,instructions,published,user_id) VALUES(:title,:ingredients,:instructions,:published,:user_id)");
	$statement->bindValue(":title",$recipe["title"]);
	$statement->bindValue(":ingredients",$recipe["ingredients"]);
	$statement->bindValue(":instructions",$recipe["instructions"]);
	$statement->bindValue(":published",$recipe["published"]);
	$statement->bindValue(":user_id",$recipe["user_id"]);
	
	if( $pdo ) {
		
		$insert = $statement->execute();
		
		if( $insert !== false ) {
			
			return true;
			
		} else {
			
			echo $statement->errorCode();
			echo $statement->errorInfo()[2];
			return false;
			
		}		
		
	} else {
		
		echo "Could not connect to the database";
		return false;
		
	}
	
}