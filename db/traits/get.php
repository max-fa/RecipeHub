<?php
require '../pdo_connect.php';
require 'get_functions.php';

function get_traits($params) {
	
	$pdo = pdo_connect();
	$results;
	$statement;
	
	if( $pdo ) {
		
		if( isset( $params["username"] ) && gettype( $params["username"] )  === "string" ) {
			
			if( isset( $params["count"] ) && gettype( $params["count"] ) === "integer" ) {
				
				if( $params["count"] > 1 ) {
					
					$results = traits_get_many( $params["count"], $params["username"], $pdo );
					
					if( $results ) {
						
						return $results;
						
					} else {
						
						echo "Could not fetch traits";
						return false;
						
					}				
					
				} else if( $params["count"] === 1 ) {
					
					if( isset($params["name"]) && gettype($params["name"]) === "string" ) {
						
						$results = traits_get_one( $params["name"], $params["username"], $pdo );
						
						if( $results !== false ) {
							
							return $results;
							
						} else {
							
							echo "Could not fetch trait";
							return false;
							
						}					
						
					} else {
						
						echo "Specific trait name is required";
						return false;
						
					}

					
				}

				
			} else {
				
				$results = traits_get_all($params["username"],$pdo);
				
				if( $results ) {
					
					return $results;
					
				} else {
					
					echo "Could not get user's traits";
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