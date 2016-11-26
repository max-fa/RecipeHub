<?php

function get_mapping($item_id,$trait_id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM item_traits_mappings WHERE item_id = :item_id AND trait_id = :trait_id");
	$statement->bindValue(":item_id",$item_id);
	$statement->bindValue(":trait_id",$trait_id);
	
	if( $statement->execute() ) {
		
		return $statement->fetch(PDO::FETCH_ASSOC);
		
	}
	
}