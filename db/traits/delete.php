<?php
require '../pdo_connect.php';

function delete_trait($id,$username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
			
		$statement = $pdo->prepare("DELETE FROM traits WHERE id = :id");
		$statement->bindValue(":id",$id);
		
		if( $statement->execute() ) {
			
			return true;
			
		} else {
			
			echo "Could not delete the trait";
			return false;
			
		}		
		
	} else {
		
		echo "Could not connect to the database";
		return false;
		
	}

	
}