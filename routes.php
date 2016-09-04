<?php

Router::register("/users",function() {
	
	echo '
	
		<b>Welcome to Users!</b>
		
		<ul>
			<li>One</li>
			<li>Two</li>
			<li>Three</li>
		</ul>
	
	';
	
});

Router::register("/recipes",function() {
	
	echo '
	
		<b>Welcome to Recipes!</b>
		
		<ul>
			<li>One</li>
			<li>Two</li>
			<li>Three</li>
		</ul>
	
	';
	
});

Router::register("/items",function() {
	
	echo '
	
		<b>Welcome to Items!</b>

		<ul>
			<li>One</li>
			<li>Two</li>
			<li>Three</li>
		</ul>
	
	';
	
});

Router::register("/secret","\\views\secret.html");

Router::protect("/secret");