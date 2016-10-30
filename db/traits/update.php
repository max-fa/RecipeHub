<?php
require '../pdo_connect.php';
require 'update_functions.php';
require 'common_functions.php';

function update_trait($id,$updates,$username) {
	
	$pdo = pdo_connect();
	$statement;
	$trait_exists;
	$user_is_owner;
	
	if( $pdo ) {
		
		$trait_exists = trait_is_real($id,$pdo);
		
		if( $trait_exists ) {
			
			$user_is_owner = user_owns_trait($id,$username,$pdo);
			
			if( $user_is_owner ) {
				
				traits_remove_invalid_fields($updates);
				traits_remove_dups($id,$updates,$pdo);
				
				if( isset($updates["name"]) ) {
					
					if( unique_trait_name( $username,$updates["name"],$pdo ) === false ) {
						
						echo "Different name";
						return false;
						
					}
					
				}
				
				if( count($updates) === 0 ) {
					
					return true;
					
				} else {
					
					$statement = $pdo->prepare( traits_build_query($updates,$pdo) );
					traits_bindValues($updates,$id,$statement);
					
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
			
			echo "That trait doesn't exist";
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}