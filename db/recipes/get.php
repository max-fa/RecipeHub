<?php
//require '../db/pdo_connect.php';

function get($params,$pdo) {

		if( isset( $params["user_id"] ) ) {
			
			return recipes_get_from_user($params["user_id"],$pdo);
			
		} else {
			
			if( isset( $params["limit"] ) ) {
				
				return recipes_get_many($params["limit"],$pdo);
				
			} else {
				
				return recipes_get_one($params["recipe_id"],$pdo);
				
			}
			
		}
	
}



function recipes_get_from_user($user_id,$pdo) {
	
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("SELECT * FROM recipes WHERE user_id = :user_id");
		$statement->bindValue(":user_id",$user_id);	
	
		if( $statement->execute() ) {
			
			return [true,$statement->fetchAll(PDO::FETCH_ASSOC)];
			
		} else {
			
			return [false,"Could not fetch recipes"];
			
		}
		
	} else {
		
		return [false,"Could not connect to database"];
		
	}
	
	
}

function recipes_get_many($limit,$pdo) {
	
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("SELECT * FROM recipes ORDER BY id LIMIT :limit");
		$statement->bindValue(":limit",$limit);
		
		if( $statement->execute() ) {
			
			return [true,$statement->fetchAll(PDO::FETCH_ASSOC)];
			
		} else {
			
			return [false,"Could not fetch recipes"];
			
		}
		
	} else {
		
		return [false,"Could not connect to database"];
		
	}
	
}



function recipes_get_one($id,$pdo) {
	
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
		$statement->bindValue(":id",$id);
		
		if( $statement->execute() ) {
			
			return [true,$statement->fetch(PDO::FETCH_ASSOC)];
			
		} else {
			
			return [false,"Could not fetch reciep"];
			
		}
		
	} else {
		
		return [false,"Could not connect to database"];
		
	}
	
}