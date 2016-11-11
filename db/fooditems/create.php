<?php

function create_fooditem($fooditem_data) {
	
	$statement = $pdo->prepare("INSERT INTO fooditems (name,description) VALUES(:name,:description)");
	$statement->bindValue(":name",$fooditem_data["name"]);
	$statement->bindValue(":description",$fooditem_data["description"]);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}