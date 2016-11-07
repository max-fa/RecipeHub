<?php
require '../db/pdo_connect.php';

function delete_fooditem($id) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("DELETE FROM fooditems WHERE id = :id");
		$statement->bindValue(":id",$id);
		
		if( $statement->execute() ) {
			
			return true;
			
		} else {
			
			echo "Could not delete the fooditem";
			return false;
			
		}		
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}

	
}