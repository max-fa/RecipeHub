<?php
require '../pdo_connect.php';
require 'common_functions.php';

function delete_fooditem($id,$username) {
	
	$pdo = pdo_connect();
	$fooditem_exists = fooditem_is_real($id,$pdo);
	$statement;
	$user_is_owner;
	if( $pdo ) {
		
		if( $fooditem_exists ) {
			
			$user_is_owner = user_owns_fooditem($id,$username,$pdo);
			
			if( $user_is_owner ) {
				
				$statement = $pdo->prepare("DELETE FROM fooditems WHERE id = :id");
				$statement->bindValue(":id",$id);
				
				if( $statement->execute() ) {
					
					return true;
					
				} else {
					
					echo "Could not delete the fooditem";
					return false;
					
				}
				
				
			} else {
				
				echo "We cannot delete: you do not have permission";
				return false;
				
			}
			
		} else {
			
			echo "fooditem doesn't exist";
			return false;
			
		}		
		
	} else {
		
		echo "Could not connect to the database";
		return false;
		
	}

	
}