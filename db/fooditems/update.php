<?php
require '../db/pdo_connect.php';
require 'update_functions.php';

function update_fooditem($id,$updates,$username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare( item_build_query($updates,$pdo) );
			item_bindValues($updates,$id,$statement);
			
			if( $statement->execute() ) {
				
				return true;
				
			} else {
				
				print_r( $pdo->errorInfo() );
				return false;
				
			}			
			
		} catch( PDOException $e ) {
			
			return [false,"Could not update fooditem"];
			
		}

		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}