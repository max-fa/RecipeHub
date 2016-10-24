<?php
require '../pdo_connect.php';
require 'common_functions.php';

function create_user($data) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		if( user_exists($data["username"],$pdo) ) {
			
			echo "Username: " . $data["username"] . " is already taken.";
			return false;			
			
		} else {
			
			$statement = $pdo->prepare("INSERT INTO users (username,password) VALUES(:username,:password)");
			$statement->bindValue(":username",$data["username"]);
			$statement->bindValue( ":password", password_hash( $data["password"],PASSWORD_DEFAULT ) );
			
			if( $statement->execute() ) {
				
				return true;
				
			} else {
				
				echo "Could not create user";
				return false;
				
			}
			
		}
		

		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}