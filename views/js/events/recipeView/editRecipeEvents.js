"use strict";

(function() {
	
	function returnToObjectView(evt) {
		
		$("#edit-recipe-form").off("submit");
		$("#edit-recipe-return").off("click");
		
		$("#edit-recipe-form-container").hide();
		$("#main-recipe-display").show();
		
	}
	
	
	
	function updateEverything(recipe) {
		
		Store.currentObject.title = recipe.title;
		Store.currentObject.ingredients = recipe.ingredients;
		Store.currentObject.instructions = recipe.instructions;
		Store.getRecipe(recipe.id).name = recipe.name;
		Store.getRecipe(recipe.id).ingredients = recipe.ingredients;
		Store.getRecipe(recipe.id).instructions = recipe.instructions;
		
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
		
	}
	
	
	
	function submitRecipeEdit(evt) {
		
		evt.preventDefault();
		
		var title = $('input[name="edit-recipe-title"]').get(0).value;
		var ingredients = $('textarea[name="edit-recipe-ingredients"]').get(0).value;
		var instructions = $('textarea[name="edit-recipe-instructions"]').get(0).value;
		
		$.ajax("http://recipehub.dev/recipes",{
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			data: JSON.stringify({
				action: "update",
				recipe_id: Store.currentObject.id,
				title: title,
				ingredients: ingredients,
				instructions: instructions
			}),
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code,
					why: xhr
				});
				
			},
			success: function(data,status,xhr) {
				
				console.log({
					data: data,
					status: status
				});
				
				updateEverything(data.recipe);
				returnToObjectView();
				
			},
			method: "POST"
		});
		
	}
	
	
	
	window.editRecipeEvents = function() {
		
		$("#edit-recipe-form").on("submit",submitRecipeEdit);
		$("#edit-recipe-return").on("click",returnToObjectView);
		
	}
	
})();