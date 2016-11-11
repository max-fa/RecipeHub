<?php
require 'update_functions.php';

function update_trait($id,$updates) {
	
	$statement = $pdo->prepare( traits_build_query($updates,$pdo) );
	traits_bindValues($updates,$id,$statement);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}