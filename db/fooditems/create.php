<?php
require '../pdo_connect.php';

function create_fooditem($fooditem_data) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("INSERT INTO fooditems (name,description,username) VALUES(:name,:description,:username)");
		$statement->bindValue(":name",$fooditem_data["name"]);
		$statement->bindValue(":description",$fooditem_data["description"]);
		$statement->bindValue(":username",$fooditem_data["username"]);
		
		if( $statement->execute() ) {
			
			return true;
			
		} else {
			
			echo "Could not create fooditem";
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}