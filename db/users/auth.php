<?php
require '../db/pdo_connect.php';
require 'common_functions.php';
require 'auth_functions.php';

function authenticate_user($credentials) {
	
	$pdo = pdo_connect();
	$user;
	$statement;
	$authenticated;
	
	if( $pdo ) {
		
		if( user_exists($credentials["username"],$pdo) ) {
			
			$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
			$statement->bindValue(":username",$credentials["username"]);
			
			if( $statement->execute() ) {
				
				$user = $statement->fetch(PDO::FETCH_ASSOC);	
				
			} else {
				
				echo "Database error,could not authenticate user";
				return false;
				
			}			
			
			$authenticated = check_credentials($credentials,$user);
			
			if( $authenticated[0] === true ) {
				
				return true;
				
			} else {
				
				echo $authenticated[1];
				return false;
				
			}
			
		} else {
			
			echo "Could not find user: " . $credentials["username"];
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}