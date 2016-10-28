<?php

function unique_fooditem_name($username,$fooditem_name,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM fooditems WHERE username = :username AND name = :name");
	$statement->bindValue(":username",$username);
	$statement->bindValue(":name",$fooditem_name);
	
	if( $statement->execute() ) {
		
		$fooditems = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		if( count($fooditems) === 0 ) {
			
			return true;
			
		} else {
			
			return false;
			
		}
		
	} else {
		
		return [false,"Could not query fooditems table"];
		
	}
	
}



function fooditem_is_real($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM fooditems WHERE id = :id");
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



function user_owns_fooditem($id,$username,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM fooditems WHERE id = :id");
	$statement->bindValue(":id",$id);
	$fooditem;
	
	if( $statement->execute() ) {
		
		$fooditem = $statement->fetch();
		
		if( $fooditem ) {
			
			if( $fooditem["username"] === $username ) {
				
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