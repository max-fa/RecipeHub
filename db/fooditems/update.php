<?php
require '../pdo_connect.php';
require 'update_functions.php';
require 'common_functions.php';

function update_fooditem($id,$updates,$username) {
	
	$pdo = pdo_connect();
	$statement;
	$fooditem_exists;
	$user_is_owner;
	
	if( $pdo ) {
		
		$fooditem_exists = fooditem_is_real($id,$pdo);
		
		if( $fooditem_exists ) {
			
			$user_is_owner = user_owns_fooditem($id,$username,$pdo);
			
			if( $user_is_owner ) {
				
				remove_invalid_fields($updates);
				remove_dups($id,$updates,$pdo);
				
				if( isset($updates["name"]) ) {
					
					if( unique_fooditem_name( $username,$updates["name"],$pdo ) === false ) {
						
						echo "Different name";
						return false;
						
					}
					
				}
				
				if( count($updates) === 0 ) {
					
					return true;
					
				} else {
					
					$statement = $pdo->prepare( build_query($updates,$pdo) );
					bindValues($updates,$id,$statement);
					
					if( $statement->execute() ) {
						
						return true;
						
					} else {
						
						print_r( $pdo->errorInfo() );
						return false;
						
					}					
					
				}
				
			} else {
				
				echo "This ain't yours!";
				return false;
				
			}
			
		} else {
			
			echo "That fooditem doesn't exist";
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}