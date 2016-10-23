<?php

function build_query($updates,$pdo) {
	
	$statement = "UPDATE recipes SET (";
	end($updates);
	$last = key($updates);
	
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

function bindValues($updates,$id,&$statement) {
	
	foreach( $updates as $column=>$value  ) {
		
		$statement->bindValue( ":" . $column,$value );
		
	}
	
	$statement->bindValue(":id",$id);
	
}