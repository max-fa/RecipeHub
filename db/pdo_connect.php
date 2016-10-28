<?php

function pdo_connect() {
	
	$pdo;
	
	try {
		
		$pdo = new PDO("");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
		
	} catch( PDOException $e ) {
		
		echo "Couldn't connect to the database";
		return false;
		
	}
	
}