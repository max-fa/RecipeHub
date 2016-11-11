<?php

function delete_trait($id,$pdo) {
	
	$statement = $pdo->prepare("DELETE FROM traits WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}