<?php
require '../db/pdo_connect.php';

function get($params) {
	
	try {
		
		if( isset( $params["single"] ) ) {
			
			return fooditems_get_one( $params["user_id"] );
			
		} else {
			
			return fooditems_get_all( $params["user_id"] );
			
		}
		
	} catch( PDOException $e ) {
		
		return [false,"Database error"];
		
	}
	
	
}



function fooditems_get_all($username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("SELECT * FROM fooditems WHERE username = :username ORDER BY id");
		$statement->bindValue(":username",$useername);
		
		if( $statement->execute() ) {
			
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
		} else {
			
			return [false,"Could not fetch fooditems"];
			
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
				
				return [false,"Could not get fooditem"];
				
			}
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}