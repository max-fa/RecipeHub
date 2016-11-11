<?php

function delete_recipe($id,$pdo) {
	
	$statement = $pdo->prepare("DELETE FROM recipes WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}