<?php
require 'update_functions.php';

function update_recipe($id,$updates,$pdo) {
	
	$statement = $pdo->prepare( recipes_build_query($updates,$pdo) );
	
	recipes_bindValues($updates,$id,$statement);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}