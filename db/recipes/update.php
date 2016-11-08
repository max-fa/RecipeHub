<?php
require '../db/pdo_connect.php';
require 'update_functions.php';

function update_recipe($id,$updates) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare( recipes_build_query($updates,$pdo) );
			
			recipes_bindValues($updates,$id,$statement);
			
			if( $statement->execute() ) {
				
				return [true];
				
			} else {
				
				return [false,"Could not update the recipe"];
				
			}
			
		} catch( PDOException $e ) {
			
			return [false,"Database error"];
			
		}
		
	} else {
		
		return [false,"Could not connect to database"];
		
	}
	
}