<?php
require '../pdo_connect.php';
require 'common_functions.php';

function dissociate_trait($fooditem_id,$trait_id,$username) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("DELETE FROM item_traits_mappings WHERE item_id = :item_id AND trait_id = :trait_id");
		$statement->bindValue(":item_id",$fooditem_id);
		$statement->bindValue(":trait_id",$trait_id);
		
		if( $statement->execute() ) {
			
			return true;
			
		} else {
			
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}