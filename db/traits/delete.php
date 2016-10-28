<?php
require '../pdo_connect.php';
require 'common_functions.php';

function delete_trait($id,$username) {
	
	$pdo = pdo_connect();
	$trait_exists = trait_is_real($id,$pdo);
	$statement;
	$user_is_owner;
	if( $pdo ) {
		
		if( $trait_exists ) {
			
			$user_is_owner = user_owns_trait($id,$username,$pdo);
			
			if( $user_is_owner ) {
				
				$statement = $pdo->prepare("DELETE FROM traits WHERE id = :id");
				$statement->bindValue(":id",$id);
				
				if( $statement->execute() ) {
					
					return true;
					
				} else {
					
					echo "Could not delete the trait";
					return false;
					
				}
				
				
			} else {
				
				echo "We cannot delete";
				return false;
				
			}
			
		} else {
			
			echo "Trait doesn't exist";
			return false;
			
		}		
		
	} else {
		
		echo "Could not connect to the database";
		return false;
		
	}

	
}