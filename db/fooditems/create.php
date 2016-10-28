<?php
require '../pdo_connect.php';
require 'common_functions.php';

function create_fooditem($fooditem_data) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		if( unique_fooditem_name($fooditem_data["username"],$fooditem_data["name"],$pdo) === true ) {
			
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
			
			echo "You already have a fooditem with that name";
			return false;
			
		}
		
	}
	
}