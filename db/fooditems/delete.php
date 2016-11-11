<?php

function delete_fooditem($id,$pdo) {
	
	$statement = $pdo->prepare("DELETE FROM fooditems WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		return [true];
		
	} else {
		
		return [false,"Could not delete fooditem"];
		
	}
	
}