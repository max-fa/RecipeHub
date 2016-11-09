<?php
require '../db/pdo_connect.php';

function get_one_recipe($request) {

	require '../db/recipes/get.php';
	require 'validators/recipes/get_validators.php';
	
	$pdo = pdo_connect();
	$valid;
	$response;
	$parsed_request;
	
	if( $pdo ) {
		
		try {
			
			$valid = valid_get_one_request($request,$pdo);
			
			if( $valid[0] === true ) {
				
				$parsed_request = [
					"user_id"=>(int)$request["user_id"],
					"recipe_id"=>(int)$request["recipe_id"]
				];
				
				$response = get($parsed_request,$pdo);
				
				if( $response[0] === true ) {
					
					header('Content-type:application/json;charset=utf-8');
					echo json_encode([
						"success"=>true,
						"recipe"=>$response[1]
					]);
					
				} else {
					
					http_response_code(500);
					echo json_encode([
						"success"=>false,
						"why"=>$response[1]
					]);
					
				}
				
			} else {
				
				http_response_code(400);
				echo json_encode([
					"success"=>false,
					"why"=>$valid[1]
				]);
				
			}			
			
		} catch( PDOException $e ) {
			
			http_response_code(500);
			echo json_encode([
				"success"=>false,
				"why"=>"Database error"
			]);
			
		}
		
	} else {
		
		http_response_code(500);
		echo json_encode([
			"success"=>false,
			"why"=>"Could not connect to database"
		]);
		
	}
	
}



function get_many_recipes($request) {
	
	require '../db/recipes/get.php';
	require 'validators/recipes/get_validators.php';
	
	$pdo = pdo_connect();
	$valid;
	$response;
	
	if( $pdo ) {
		
		try {
			
			$valid = valid_get_many_request($request,$pdo);
			
			if( $valid[0] === true ) {
				
				$parsed_request = strip_params( convert_query_string($request,["limit"]),["limit"] );
				$response = get($parsed_request,$pdo);
				
				if( $response[0] === true ) {
					
					header('Content-type:application/json;charset=utf-8');
					echo json_encode([
						"success"=>true,
						"recipes"=>$response[1]
					]);
					
				} else {
					
					http_response_code(500);
					echo json_encode([
						"success"=>false,
						"why"=>$response[1]
					]);
					
				}
				
			} else {
				
				http_response_code(400);
				echo json_encode([
					"success"=>false,
					"why"=>$valid[1]
				]);
				
			}
			
		} catch( PDOException $e ) {
			
			http_response_code(500);
			echo json_encode([
				"success"=>false,
				"why"=>"Database error"
			]);
			
		}
		
	} else {
		
		http_response_code(500);
		echo json_encode([
			"success"=>false,
			"why"=>"Could not connect to database"
		]);
		
	}	
	
}



function get_user_recipes($request) {
	
	require '../db/recipes/get.php';
	require 'validators/recipes/get_validators.php';
	
	$pdo = pdo_connect();
	$valid;
	$response;
	
	if( $pdo ) {
		
		try {
			
			$valid = valid_get_from_user_request($request,$pdo);
			
			if( $valid[0] === true ) {
				
				$parsed_request = strip_params( convert_query_string($request,["user_id"]),["user_id"] );
				$response = get($parsed_request,$pdo);
				
				if( $response[0] === true ) {
					
					header('Content-type:application/json;charset=utf-8');
					echo json_encode([
						"success"=>true,
						"recipes"=>$response[1]
					]);
					
				} else {
					
					http_response_code(500);
					echo json_encode([
						"success"=>false,
						"why"=>$response[1]
					]);
					
				}
				
			} else {
				
				http_response_code(400);
				echo json_encode([
					"success"=>false,
					"why"=>$valid[1]
				]);
				
			}
			
		} catch( PDOException $e ) {
			
			http_response_code(500);
			echo json_encode([
				"success"=>false,
				"why"=>"Database error"
			]);
			
		}
		
	} else {
		
		http_response_code(500);
		echo json_encode([
			"success"=>false,
			"why"=>"Could not connect to database"
		]);
		
	}
	
}