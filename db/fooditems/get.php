<?php
require '../pdo_connect.php';
require 'get_functions.php';

function get_fooditems($params) {
	
	$pdo = pdo_connect();
	$results;
	$statement;
	
	if( $pdo ) {
		
		if( isset( $params["username"] ) && gettype( $params["username"] )  === "string" ) {
			
			if( isset( $params["count"] ) && gettype( $params["count"] ) === "integer" ) {
				
				if( $params["count"] > 1 ) {
					
					$results = get_many( $params["count"], $params["username"], $pdo );
					
					if( $results ) {
						
						return $results;
						
					} else {
						
						echo "Could not fetch fooditems";
						return false;
						
					}				
					
				} else if( $params["count"] === 1 ) {
					
					if( isset($params["name"]) && gettype($params["name"]) === "string" ) {
						
						$results = get_one( $params["name"], $params["username"], $pdo );
						
						if( $results !== false ) {
							
							return $results;
							
						} else {
							
							echo "Could not fetch fooditem";
							return false;
							
						}					
						
					} else {
						
						echo "Specific fooditem name is required";
						return false;
						
					}

					
				}

				
			} else {
				
				$results = get_all($params["username"],$pdo);
				
				if( $results ) {
					
					return $results;
					
				} else {
					
					echo "Could not get user's fooditems";
					return false;
					
				}
				
			}			
			
		} else {
			
			echo "Must provide a username";
			return false;
			
		}
		
	} else {
		
		echo "Could not connect to database";
		return false;
		
	}
	
}