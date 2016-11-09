<?php

register_route("/",function() {
	
	//require '../views/index.php';
	echo "Welcome";
	
},null);


/* 
	Start: resource routes
*/


register_route("/recipes",function($request) {
	
	require '../db/pdo_connect.php';
	require '../db/recipes/get.php';
	require 'validators/recipes/retrieval_validators.php';
	
	$pdo = pdo_connect();
	$valid;
	$response;
	$int_request;
	
	if( $pdo ) {
		
		$valid = valid_get_one_request($request,$pdo);
		
		try {
			
			switch( $request["action"] ) {
				
				case "one":
					
					if( $valid[0] === true ) {
						
						header('Content-type:application/json;charset=utf-8');
						
						$parsed_request = [
							"user_id"=>(int)$request["user_id"],
							"recipe_id"=>(int)$request["recipe_id"]
						];
						
						$response = get($parsed_request,$pdo);
						
						if( $response[0] === true ) {
							
							echo json_encode(
								[
									"success"=>true,
									"recipe"=>$response[1]
								]
							);
							
						} else {
							
							echo json_encode(
								[
									"success"=>false,
									"why"=>$response[1]
								]
							);
							
						}
						
					} else {
						
						http_response_code(400);
						echo json_encode(
							[
								"success"=>false,
								"why"=>$valid[1]
							]
						);
						
					}
					
					break;
					
				case "many":
					
					if( recipes_valid_get_many($request) ) {
						
						header('Content-type:application/json;charset=utf-8');
						return get($request);
						
					} else {
						
						echo '400';
						
					}
					
					break;
					
				case "from_user":
					
					if( recipes_valid_get_from_user($request) ) {
						
						header('Content-type:application/json;charset=utf-8');
						return get($request);
						
					} else {
						
						echo '400';
						
					}
					
					break;
					
				default:
					//return a Bad Request error
					break;
				
			}			
			
		} catch( PDOException $e ) {
			
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

	
},"GET",false);



register_route("/recipes",function($request) {
	
	switch( $request["action"] ) {
		
		case "create":
			
			break;
		
		case "update":
			
			break;
			
		case "publish":
			
			break;
			
		default:
			//Bad Request
			break;
		
	}
	
},"POST");



register_route("/recipes",function($request) {
	
	//require '../db/recipes/delete.php';
	
	/* delete recipe here */
	
},"DELETE");



register_route("/users",function($request) {
	
	//require '../db/users/get.php';
	
	/* get a user */
	
},"GET");



register_route("/users",function($request) {
	
	if( $request["action"] === "create" ) {
		
		//require '../db/users/create.php';
		
	} else if( $request["action"] === "update" ) {
		
		//require '../db/users/update.php';
		
	} else {
		
		/* Bad Request */
		
	}
	
},"POST");



register_route("/users",function($request) {
	
	//require '../db/users/delete.php';
	
},"DELETE");



register_route("/login",function($request) {
	
	//require '../db/users/get.php';
	
},"POST");



register_route("/logout",function($request) {
	
	//require '../db/users/get.php';
	
},"POST");



register_route("/fooditems",function($request) {
	
	if( $request["action"] === "one" ) {
		
		
		
	} else if( $request["action"] === "from_user" ) {
		
		
		
	} else {
		
		/* Bad Request */
		
	}
	
},"GET");



register_route("/fooditems",function($request) {
	
	switch( $request["action"] ) {
		
		case "create":
			
			break;
			
		case "update":
			
			break;
			
		case "associate":
			
			break;
			
		case "dissociate":
			
			break;
			
		default:
			/* Bad Request */
			break;
		
	}
	
},"POST");



register_route("/fooditems",function($request) {
	
	
	
},"DELETE");



register_route("/traits",function($request) {
	
	if( $request["action"] === "one" ) {
		
		
		
	} else if( $request["action"] === "from_user" ) {
		
		
		
	} else {
		
		/* Bad Request */
		
	}
	
},"GET");



register_route("/traits",function($request) {
	
	if( $request["action"] === "create" ) {
		
		
		
	} else if( $request["action"] === "update" ) {
		
		
		
	} else {
		
		/* Bad Request */
		
	}
	
},"POST");



register_route("/traits",function($request) {
	
	
	
},"DELETE");

/* 
	End: resource routes
*/

register_route("/css",function() {
	
	$dir = scandir("../views/css");
	$i = 0;
	$output = "<ul>";
	
	while( $i < count($dir) ) {
		
		if( $i >= 2 ) {
			
			$output .= "
				<li>$dir[$i]</li>
			";
			
		}
		
		$i++;
		
	}
	
	$output .= "</ul>";
	echo $output;	
	
},null);



register_route("/css/loggedout.css",function() {
	
	header("Content-type: text/css");
	readfile("../views/css/loggedout.css");
	
},null);



register_route("/css/simplegrid.css",function() {
	
	header("Content-type: text/css");
	readfile("../views/css/simplegrid.css");
	
},null);