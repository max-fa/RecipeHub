<?php
require 'update_functions.php';

function update_fooditem($id,$updates,$pdo) {
	
	foreach( $updates as $update=>$to ) {
		
		if( $to === "" ) {
			
			unset($updates[$update]);
			
		}
		
	}
	
	if( count($updates) === 0 ) {
		
		return true;
		
	}
	
	$statement = $pdo->prepare( item_build_query($updates) );
	item_bindValues($updates,$id,$statement);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		print_r( $pdo->errorInfo() );
		return false;
		
	}
	
}