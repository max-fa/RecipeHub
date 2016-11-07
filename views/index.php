<?php
require 'db/test_api.php';

$recipes = get_recipes("many");
$recipe_list = "<ul>";
end( $recipes );
$end_of_recipes = key( $recipes );
foreach( $recipes as $recipe ) {
	
	if( key( $recipes ) === $end_of_recipes  ) {
		
		$recipe_list .= "<li class=\"$recipe\">$recipe</li>";
		$recipe_list .= "</ul>";
		
	} else {
		
		$recipe_list .= "<li class=\"$recipe\">$recipe</li>";
		
	}
	
}

$template = file_get_contents("C:/xampp/htdocs/my_docs/RecipeHub/views/index.html");
$compiled_template = str_replace("@recipe-list",$recipe_list,$template);
$compiled_template = str_replace("@username","maximos",$compiled_template);
echo $compiled_template;

