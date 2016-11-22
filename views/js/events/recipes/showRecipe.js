"use strict";

(function() {
	
	/* fetch a recipe from the server and pass it to fetchTraits() */
	function fetchRecipe(callbackOne,callbackTwo,id) {
		
		$.ajax("http://recipehub.dev/recipes?action=one&recipe_id=" + id,{
			contentType: "text/plain",
			dataType: "json",
			cache: true,
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code
				});
				
			},
			success: function(data,status,xhr) {
				
				callbackOne(callbackTwo,data.recipe);
				
			},
			method: "GET"
			
		});
		
	}
	
	
	
	/* fetch all traits that could be associated with a recipe's ingredients and pass the recipe and it's traits to showObjectView() */
	function fetchTraits(callbackOne,recipe) {
		
		$.ajax("http://recipehub.dev/fooditems?action=traits&names=" + recipe.ingredients,{
			contentType: "text/plain",
			dataType: "json",
			cache: true,
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code
				});
				
			},
			success: function(data,status,xhr) {
				
				var newRecipe = Object.assign({},recipe);
				newRecipe.traits = data.traits;
				callbackOne(newRecipe);
				
			},
			method: "GET"
		});
		//recipe.ingredients.split(",");
		
	}
	
	
	
	/* Recieve the recipe data along with any traits it may have and display it */
	function showObjectView(recipe) {
		
		$("#list-view").css("display","none");
		$("#object-view").css("display","block");
		$("#recipe-display").css("display","block");
		
		$("#recipe-title").html(recipe.title);
		$("#recipe-body > p").html(recipe.instructions);
		
		recipe.ingredients.split(",").forEach(function(ingredient,index,ingredients) {
			
			$("#recipe-ingredients").append(function() {
				
				var el = document.createElement("LI");
				el.innerHTML = ingredient;
				el.setAttribute("class","recipe-ingredient");
				return el;
				
			});
			
		});
		
		recipe.traits.forEach(function(traitObj,index,traits) {
			
			$("#recipe-traits").append(function() {
				
				//attach a click handler to these traits and the ingredients above in a separate function
				var el = document.createElement("LI");
				el.innerHTML = traitObj.name;
				el.setAttribute("data-trait-id",traitObj.id);
				el.setAttribute("class","recipe-trait");
				return el;
				
			});
			
		});
		
		recipeViewEvents();
		
	}
	
	
	
	window.showRecipe = function(evt) {
		
		var id = $(this).attr("data-recipe_id");
		//showObjectView(fetchTraits(fetchRecipe()));
		
		fetchRecipe(fetchTraits,showObjectView,id);
		
	}
	
})();