<?php

function traits_get($params,$pdo) {
	
	if( isset( $params["trait_id"] ) ) {
		
		return traits_get_one( $params["trait_id"],$pdo );
		
	} else {
		
		return traits_get_all($pdo);
		
	}
	
}



function traits_get_all($pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM traits ORDER BY id");
	
	if( $statement->execute() ) {
		
		return $statement->fetchAll(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}



function traits_get_one($id,$pdo) {
	
	$statement = $pdo->prepare("SELECT * FROM traits WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		return $statement->fetch(PDO::FETCH_ASSOC);
		
	} else {
		
		return false;
		
	}
	
}



function traits_from_fooditems($fooditems,$pdo) {
	
	$trait_ids = [];
	$trait_id;
	$traits = [];
	$trait;
	$statement;
	
	foreach( $fooditems as $fooditem ) {
		
		$statement = $pdo->prepare("SELECT trait_id FROM item_traits_mappings WHERE item_id = :item_id");
		$statement->bindValue(":item_id",$fooditem["id"]);
		
		if( $statement->execute() ) {
			
			$trait_id = $statement->fetch(PDO::FETCH_ASSOC)["trait_id"];
			array_push($trait_ids,$trait_id);
			
		}
		
	}
	
	unset($trait_id);
	
	foreach( $trait_ids as $trait_id ) {
		
		$statement = $pdo->prepare("SELECT * FROM traits WHERE id = :id");
		$statement->bindValue(":id",$trait_id);
		
		if( $statement->execute() ) {
			
			$trait = $statement->fetch(PDO::FETCH_ASSOC);
			array_push($traits,$trait);
			
		}
		
	}
	
	return $traits;
	
}



function traits_from_fooditem($item_id,$pdo) {
	
	$trait_ids;
	$traits = [];
	
	$statement = $pdo->prepare("SELECT trait_id FROM item_traits_mappings WHERE item_id = :item_id");
	$statement->bindValue(":item_id",$item_id);
	if( $statement->execute() ) {
		
		$trait_ids = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		foreach( $trait_ids as $trait_id ) {
			
			$statement = $pdo->prepare("SELECT * FROM traits WHERE id = :id");
			$statement->bindValue(":id",$trait_id["trait_id"]);
			if( $statement->execute() ) {
				
				array_push($traits,$statement->fetch(PDO::FETCH_ASSOC));
				
			} else {
				
				return false;
				
			}
			
		}
		
		return $traits;
		
	} else {
		
		return false;
		
	}
	
}