<?php

function unique_trait_name($username,$trait_name,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM traits WHERE username = :username AND name = :name");
	$statement->bindValue(":username",$username);
	$statement->bindValue(":name",$trait_name);
	
	if( $statement->execute() ) {
		
		$traits = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		if( count($traits) === 0 ) {
			
			return true;
			
		} else {
			
			return false;
			
		}
		
	} else {
		
		return [false,"Could not query traits table"];
		
	}
	
}