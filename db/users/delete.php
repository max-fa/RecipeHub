<?php
require '../db/pdo_connect.php';

function delete_user($username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("DELETE FROM users WHERE username = :username");
		$statement->bindValue(":username",$username);
		
		if( $statement->execute() ) {
			
			return true;
			
		} else {
			
			echo "Could not delete user";
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}