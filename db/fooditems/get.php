<?php

function get($params) {
	
	if( isset( $params["all"] ) ) {
		
		return fooditems_get_all();
		
	} else {
		
		return fooditems_get_one($params["id"]);
		
	}
	
}



function fooditems_get_all() {
	
	$statement = $pdo->prepare("SELECT * FROM fooditems ORDER BY id");
	
	if( $statement->execute() ) {
		
		return $statement->fetchAll(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}



function fooditems_get_one($id) {
	
	$statement = $pdo->prepare("SELECT * FROM fooditems WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		return $statement->fetch(PDO::FETCH_ASSOC);
		
	} else {
		
		return [false,"Could not get fooditem"];
		
	}
	
}