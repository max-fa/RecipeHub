<?php

function create_trait($trait_data) {
	
	$statement = $pdo->prepare("INSERT INTO traits (name,description,username) VALUES(:name,:description)");
	$statement->bindValue(":name",$trait_data["name"]);
	$statement->bindValue(":description",$trait_data["description"]);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}