<?php

function trait_is_real($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM traits WHERE id = :id");
	$statement->bindValue(":id",$id);
	$result = $statement->execute();
	
	if( $result === true ) {
		
		if( $statement->fetch() ) {
			
			return true;
			
		} else {
			
			return false;
			
		}		
		
	} else {
		
		return false;
		
	}
	
}



function not_already_associated($fooditem_id,$trait_id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM item_traits_mappings WHERE item_id = :item_id AND trait_id = :trait_id");
	$statement->bindValue(":item_id",$fooditem_id);
	$statement->bindValue(":trait_id",$trait_id);
	
	if( $statement->execute() ) {
		
		if( $statement->fetch(PDO::FETCH_ASSOC) ) {
			
			return false;
			
		} else {
			
			return true;
			
		}
		
	} else {
		
		echo "Could not query associations table";
		return "DIE";
		
	}
	
}



function trait_user_is_owner_both($item_id,$trait_id,$username,$pdo) {
	
	$user_owns_item = user_owns_fooditem($item_id,$username,$pdo);
	$user_owns_trait = user_owns_trait($trait_id,$username,$pdo);
	
	if( $user_owns_item && $user_owns_trait ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}