<?php
require '../pdo_connect.php';
require 'common_functions.php';

function delete_user($username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		if( user_exists($username,$pdo) ) {
			
			$statement = $pdo->prepare("DELETE FROM users WHERE username = :username");
			$statement->bindValue(":username",$username);
			
			if( $statement->execute() ) {
				
				return true;
				
			} else {
				
				echo "Could not delete user";
				return false;
				
			}
			
		} else {
			
			echo "User: '" . $username . "' doesn't exist";
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}