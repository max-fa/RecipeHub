<?php
require '../db/pdo_connect.php';
require 'common_functions.php';

function delete_recipe($id) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("DELETE FROM recipes WHERE id = :id");
		$statement->bindValue(":id",$id);
		
		if( $statement->execute() ) {
			
			return true;
			
		} else {
			
			echo "Could not delete the recipe";
			return false;
			
		}		
		
	} else {
		
		echo "Could not connect to the database";
		return false;
		
	}

	
}