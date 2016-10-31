<?php
require '../pdo_connect.php';
require 'update_functions.php';

function update_recipe($id,$updates) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
				
		$statement = $pdo->prepare( recipes_build_query($updates,$pdo) );
		
		recipes_bindValues($updates,$id,$statement);
		
		if( $statement->execute() ) {
			
			return true;
			
		} else {
			
			echo "Could not update";
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}