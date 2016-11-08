<?php
require '../db/pdo_connect.php';

function get($params) {
	
	try {
		
		if( isset( $params["single"] ) ) {
			
			return traits_get_one( $params["user_id"] );
			
		} else {
			
			return traits_get_all( $params["user_id"] );
			
		}
		
	} catch( PDOException $e ) {
		
		return [false,"Database error"];
		
	}
	
	
}



function traits_get_all($username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("SELECT * FROM traits WHERE username = :username ORDER BY id");
		$statement->bindValue(":username",$useername);
		
		if( $statement->execute() ) {
			
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
		} else {
			
			return [false,"Could not fetch traits"];
			
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
				
				return [false,"Could not get trait"];
				
			}
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}