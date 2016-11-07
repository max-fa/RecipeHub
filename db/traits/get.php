<?php
require '../db/pdo_connect.php';

function traits_get_all($username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("SELECT * FROM traits WHERE username = :username ORDER BY id");
		$statement->bindValue(":username",$username);
		
		if( $statement->execute() ) {
			
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
		} else {
			
			echo "Could not fetch traits";
			return false;
			
		}
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}



function traits_get_one($id) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
			$statement = $pdo->prepare("SELECT * FROM traits WHERE id = :id");
			$statement->bindValue(":id",$id);
			
			if( $statement->execute() ) {
				
				return $statement->fetch(PDO::FETCH_ASSOC);
				
			} else {
				
				echo "Could not get trait";
				return false;
				
			}
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}