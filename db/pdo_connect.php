<?php

function pdo_connect() {
	
	$pdo;
	
	try {
		
		
		return $pdo;
		
	} catch( PDOException $e ) {
		
		echo "Couldn't connect to the database";
		return false;
		
	}
	
}