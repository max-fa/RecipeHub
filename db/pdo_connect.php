<?php

function pdo_connect() {
	
	$pdo;
	
	try {
		
		
		return $pdo;
		
	} catch( PDOException $e ) {
		
		die("Couldn't connect to database.");
		
	}
	
}