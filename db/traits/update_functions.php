<?php

function build_query($updates,$pdo) {
	
	$statement = "UPDATE traits SET (";
	end($updates);
	$last = key($updates);
	
	if( count( $updates ) === 1 ) {
		
		reset($updates);
		$statement = "UPDATE traits SET " . key($updates) . " = " . ":" . key($updates) . " WHERE id = :id";
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

function bindValues($updates,$id,&$statement) {

	foreach( $updates as $column=>$value  ) {
		
		$statement->bindValue( ":" . $column,$value );
		
	}
	
	$statement->bindValue(":id",$id);
	
}



function remove_dups($id,&$updates,$pdo) {
	
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



function remove_invalid_fields(&$updates) {
	
	$bad_fields = ["id","username"];
	
	foreach( $updates as $key=>$val ) {
		
		if( in_array($key,$bad_fields,true) ) {
			
			unset($updates[$key]);
			
		}
		
	}
	
}