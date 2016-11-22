<?php

function fooditems_get($params,$pdo) {
	
	if( isset( $params["item_id"] ) ) {
		
		return fooditems_get_one($params["item_id"],$pdo);
		
	} else if( isset( $params["names"] ) ) {
		
		return fooditems_get_array($params["names"],$pdo);
		
	} else {
		
		return fooditems_get_all($pdo);
		
	}
	
}



function fooditems_get_array_from_names($names,$pdo) {
	
	$statement;
	$fooditems = [];
	
	foreach( $names as $name ) {
		
		$statement = $pdo->prepare("SELECT * FROM fooditems WHERE name = :name");
		$statement->bindValue(":name",$name);
		
		if( $statement->execute() ) {
			
			array_push( $fooditems,$statement->fetch(PDO::FETCH_ASSOC) );
			
		}
		
	}
	
	return array_filter($fooditems,function($fooditem) {
		
		if( $fooditem === false ) {
			
			return false;
			
		} else {
			
			return true;
			
		}
		
	});
	
}



function fooditems_get_all($pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM fooditems ORDER BY id");
	
	if( $statement->execute() ) {
		
		return $statement->fetchAll(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}



function fooditems_get_one($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM fooditems WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		return $statement->fetch(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}