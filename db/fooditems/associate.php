<?php
require '../pdo_connect.php';

function associate_trait($fooditem_id,$trait_id) {
	
	$pdo = pdo_connect();
	$statement;
	
	if( $pdo ) {
		
		$statement = $pdo->prepare("INSERT INTO item_traits_mappings (trait_id,item_id) VALUES(:trait_id,:item_id)");
		$statement->bindValue(":trait_id",$trait_id);
		$statement->bindValue(":item_id",$fooditem_id);
		
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