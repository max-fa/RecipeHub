<?php

function create_recipe($recipe,$pdo) {
	
	$statement = $pdo->prepare("INSERT INTO recipes (title,ingredients,instructions) VALUES(:title,:ingredients,:instructions)");
	$statement->bindValue(":title",$recipe["title"]);
	$statement->bindValue(":ingredients",$recipe["ingredients"]);
	$statement->bindValue(":instructions",$recipe["instructions"]);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}