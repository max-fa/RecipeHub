<?php

Router::serve("/users",function() {
	
	echo '
	
		<b>Welcome to Users!</b>
		
		<ul>
			<li>One</li>
			<li>Two</li>
			<li>Three</li>
		</ul>
	
	';
	
});

Router::serve("/recipes",function() {
	
	echo '
	
		<b>Welcome to Recipes!</b>
		
		<ul>
			<li>One</li>
			<li>Two</li>
			<li>Three</li>
		</ul>
	
	';
	
});

Router::serve("/items",function() {
	
	echo '
	
		<b>Welcome to Items!</b>

		<ul>
			<li>One</li>
			<li>Two</li>
			<li>Three</li>
		</ul>
	
	';
	
});

Router::serve("/secret","\\views\secret.html");

Router::protect("/secret");

//Router::expose("\\views\resources");