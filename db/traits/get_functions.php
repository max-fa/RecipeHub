<?php

function get_many($limit,$username,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM traits WHERE username = :username ORDER BY id LIMIT :limit");
	$statement->bindValue(":username",$username);
	$statement->bindValue(":limit",$limit);
	
	if( $statement->execute() ) {
		
		return $statement->fetchAll(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}



function get_one($name,$username,$pdo) {
	
	$result;
	$statement = $pdo->prepare("SELECT * FROM traits WHERE username = :username AND name = :name");
	$statement->bindValue(":username",$username);
	$statement->bindValue(":name",$name);
	
	if( $statement->execute() ) {
		
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		
		if( $result ) {
			
			return $result;
			
		} else {
			
			return null;
			
		}
		
		
	} else {
		
		return false;
		
	}
	
}



function get_all($username,$pdo) {
	
		$statement = $pdo->prepare("SELECT * FROM traits WHERE username = :username ORDER BY id");
		$statement->bindValue(":username",$username);
		
		if( $statement->execute() ) {
			
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
		} else {
			
			return false;
			
		}	
	
}