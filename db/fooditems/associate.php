<?php
require '../pdo_connect.php';
require 'common_functions.php';
require 'associate_functions.php';

function associate_trait($fooditem_id,$trait_id,$username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		if( fooditem_is_real($fooditem_id,$pdo) && trait_is_real($trait_id,$pdo) ) {
			
			if( trait_user_is_owner_both($fooditem_id,$trait_id,$username,$pdo) ) {
				
				if( not_already_associated($fooditem_id,$trait_id,$pdo) ) {
					
					$statement = $pdo->prepare("INSERT INTO item_traits_mappings (trait_id,item_id) VALUES(:trait_id,:item_id)");
					$statement->bindValue(":trait_id",$trait_id);
					$statement->bindValue(":item_id",$fooditem_id);
					
					if( $statement->execute() ) {
						
						return true;
						
					} else {
						
						return false;
						
					}				
					
				} else {
					
					return true;
					
				}				
				
			} else {
				
				echo "You don't own this";
				return false;
				
			}
			
		} else {
			
			echo "Trait or fooditem doesn't exist";
			return false;
			
		}

		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}