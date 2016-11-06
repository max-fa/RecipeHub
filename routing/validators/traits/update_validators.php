<?php

function traits_remove_dups($id,&$updates,$pdo) {
	
	$trait;
	$statement = $pdo->prepare("SELECT * FROM traits WHERE id = :id");
	$statement->bindValue(":id",$id);
	
	if( $statement->execute() ) {
		
		$trait = $statement->fetch(PDO::FETCH_ASSOC);
		
		foreach( $trait as $key=>$val ) {
			
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



function traits_remove_invalid_fields(&$updates) {
	
	$bad_fields = ["id","username"];
	
	foreach( $updates as $key=>$val ) {
		
		if( in_array($key,$bad_fields,true) ) {
			
			unset($updates[$key]);
			
		}
		
	}
	
}