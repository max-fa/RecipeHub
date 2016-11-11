<?php

function get($params) {
	
	if( isset( $params["trait_id"] ) ) {
		
		return traits_get_one( $params["trait_id"],$pdo );
		
	} else {
		
		return traits_get_all($pdo);
		
	}
	
}



function traits_get_all($pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM traits ORDER BY id");
	
	if( $statement->execute() ) {
		
		return $statement->fetchAll(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}



function traits_get_one($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM traits WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		return $statement->fetch(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}