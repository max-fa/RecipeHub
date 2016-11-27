<?php
require 'update_functions.php';

function update_recipe($id,$updates,$pdo) {
	
	foreach( $updates as $update=>$to ) {
		
		if( $to === "" ) {
			
			unset($updates[$update]);
			
		}
		
	}
	
	if( count($updates) === 0 ) {
		
		return true;
		
	}
	
	$statement = $pdo->prepare( recipes_build_query($updates,$pdo) );
	
	recipes_bindValues($updates,$id,$statement);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}