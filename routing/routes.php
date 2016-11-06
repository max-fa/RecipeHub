<?php

register_route("/",function() {
	
	//require '../views/index.php';
	echo "Welcome";
	
},null);


/* 
	Start: resource routes
*/


register_route("/recipes",function($request) {
	
	require '../db/recipes/get.php';
	
	switch( $request["action"] ) {
		
		case "one":
			echo json_encode( ["recipe"=>"just the one"] );
			break;
			
		case "many":
			
			break;
			
		case "from_user":
			
			break;
			
		default:
			//return a Bad Request error
			break;
		
	}
	
	/* if( $recipes ) {
		
		header('Content-type:application/json;charset=utf-8');
		echo json_encode($recipes);
		
	} else {
		
		echo json_encode("Could not fetch recipes");
		
	} */
	
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