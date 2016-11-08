<?php
require '../db/pdo_connect.php';
require 'update_functions.php';

function update_trait($id,$updates,$username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		try {
			
			$statement = $pdo->prepare( traits_build_query($updates,$pdo) );
			traits_bindValues($updates,$id,$statement);
			
			if( $statement->execute() ) {
				
				return [true];
				
			} else {
				
				return [false,"Could not update trait"];
				
			}			
			
		} catch( PDOException $e ) {
			
			return [false,"Database error"];
			
		}
		
	} else {
		
		return [false,"Could not connect to the database"];
		
	}
	
}