<?php

function unique_username($username,$user_name,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username AND name = :name");
	$statement->bindValue(":username",$username);
	$statement->bindValue(":name",$user_name);
	
	if( $statement->execute() ) {
		
		$users = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		if( count($users) === 0 ) {
			
			return true;
			
		} else {
			
			return false;
			
		}
		
	} else {
		
		return [false,"Could not query users table"];
		
	}
	
}



function user_is_real($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
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



function user_owns_user($id,$username,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
	$statement->bindValue(":id",$id);
	$user;
	
	if( $statement->execute() ) {
		
		$user = $statement->fetch();
		
		if( $user ) {
			
			if( $user["username"] === $username ) {
				
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