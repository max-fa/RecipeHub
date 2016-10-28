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



function trait_is_real($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM traits WHERE id = :id");
	$statement->bindValue(":id",$id);
	$result = $statement->execute();
	
	if( $result === true ) {
		
		if( $statement->fetch() ) {
			
			return true;
			
		} else {
			
			return false;
			
		}
		
		
	} else {
		
		return false;
		
	}
	
}



function user_owns_trait($id,$username,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM traits WHERE id = :id");
	$statement->bindValue(":id",$id);
	$trait;
	
	if( $statement->execute() ) {
		
		$trait = $statement->fetch();
		
		if( $trait ) {
			
			if( $trait["username"] === $username ) {
				
				return true;
				
			} else {
				
				return false;
				
			}
			
		}
		
	} else {
		
		echo "Statement failed";
		return false;
		
	}
	
}