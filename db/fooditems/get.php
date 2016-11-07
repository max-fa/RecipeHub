<?php
require '../db/pdo_connect.php';

function fooditems_get_all($username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("SELECT * FROM fooditems WHERE username = :username ORDER BY id");
		$statement->bindValue(":username",$useername);
		
		if( $statement->execute() ) {
			
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
		} else {
			
			echo "Could not fetch fooditems";
			return false;
			
		}
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}



function fooditems_get_one($id) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
			$statement = $pdo->prepare("SELECT * FROM fooditems WHERE id = :id");
			$statement->bindValue(":id",$id);
			
			if( $statement->execute() ) {
				
				return $statement->fetch(PDO::FETCH_ASSOC);
				
			} else {
				
				echo "Could not get fooditem";
				return false;
				
			}
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}