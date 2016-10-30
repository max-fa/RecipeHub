<?php

function item_build_query($updates,$pdo) {
	
	$statement = "UPDATE fooditems SET (";
	end($updates);
	$last = key($updates);
	
	if( count( $updates ) === 1 ) {
		
		reset($updates);
		$statement = "UPDATE fooditems SET " . key($updates) . " = " . ":" . key($updates) . " WHERE id = :id";
		return $statement;
		
	} else {
		
		foreach( $updates as $column=>$value ) {
			
			if( $column === $last ) {
				
				$statement .= $column . ")";
				
			} else {
				
				$statement .= $column . ",";
				
			}
			
		}
		
		$statement .= " = (";
		
		foreach( $updates as $column=>$value ) {
			
			if( $column === $last ) {
				
				$statement .= ":" . $column . ")";
				
			} else {
				
				$statement .= ":" . $column . ",";
				
			}
			
		}
		
		$statement .= " WHERE id = :id";
		
		return $statement;		
		
	}
	
}

function item_bindValues($updates,$id,&$statement) {

	foreach( $updates as $column=>$value  ) {
		
		$statement->bindValue( ":" . $column,$value );
		
	}
	
	$statement->bindValue(":id",$id);
	
}



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