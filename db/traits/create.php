<?php
require '../pdo_connect.php';
require 'create_functions.php';

function create_trait($trait_data) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		if( unique_trait_name($trait_data["username"],$trait_data["name"],$pdo) === true ) {
			
			$statement = $pdo->prepare("INSERT INTO traits (name,description,username) VALUES(:name,:description,:username)");
			$statement->bindValue(":name",$trait_data["name"]);
			$statement->bindValue(":description",$trait_data["description"]);
			$statement->bindValue(":username",$trait_data["username"]);
			
			if( $statement->execute() ) {
				
				return true;
				
			} else {
				
				echo "Could not create trait";
				return false;
				
			}
			
		} else {
			
			echo "You already have a trait with that name";
			return false;
			
		}
		
	}
	
}