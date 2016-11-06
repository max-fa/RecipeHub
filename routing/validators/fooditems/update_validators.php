<?php

function item_remove_dups($id,&$updates,$pdo) {
	
	$fooditem;
	$statement = $pdo->prepare("SELECT * FROM fooditems WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		$fooditem = $statement->fetch(PDO::FETCH_ASSOC);
		
		foreach( $fooditem as $key=>$val ) {
			
			if( isset($updates[$key]) ) {
				
				if( $updates[$key] === $val ) {
					
					unset( $updates[$key] );
					
				}
				
			}
			
		}
		
	} else {
		
		return false;
		
	}
	
}



function item_remove_invalid_fields(&$updates) {
	
	$bad_fields = ["id","username"];
	
	foreach( $updates as $key=>$val ) {
		
		if( in_array($key,$bad_fields,true) ) {
			
			unset($updates[$key]);
			
		}
		
	}
	
}