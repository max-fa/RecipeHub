"use strict";

(function() {
	
	function validateNewRecipe(evt) {
		
		evt.preventDefault();
		
		var title = $('input[name="new-recipe-title"]').get(0).value;
		var ingredients = $('textarea[name="new-recipe-ingredients"]').get(0).value;
		var instructions = $('textarea[name="new-recipe-instructions"]').get(0).value;
		
		$.ajax("http://recipehub.dev/recipes",{
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			data: JSON.stringify({
				action: "create",
				title: title,
				ingredients: ingredients,
				instructions: instructions
			}),
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code,
					request: xhr
				});
				
			},
			success: function(data,status,xhr) {
				
				console.log({
					data: data,
					status: status
				});
				
				Store.recipes.push(data.recipe);
				printRecipe(data.recipe);
				returnToListView();
				
			},
			method: "POST"
		});
		
	}
	
	
	
	function printRecipe(recipe) {
		
		$("#recipe-list").append(function() {
			
			var el = document.createElement("LI");
			el.innerHTML = recipe.title;
			el.setAttribute("class","recipe");
			el.setAttribute("data-recipe_id",recipe.id);
			
			return el;
			
		});
		
	}
	
	
	
	function returnToListView(evt) {
		
		$("#form-view").hide();
		$("#create-recipe-form-container").hide();
		$("#create-recipe-form").get(0).reset();
		$("#list-view").show();
		
		$("#create-recipe-form").off("submit");
		$("#create-recipe-return").off("click");
		
	}
	
	
	
	function createRecipeEvents() {
		
		$("#create-recipe-form").on("submit",validateNewRecipe);
		$("#create-recipe-return").on("click",returnToListView);
		
	}
	
	
	
	window.showCreateRecipeForm = function() {
		
		$("#list-view").hide();
		$("#form-view").show();
		$("#create-recipe-form-container").show();
		createRecipeEvents();
		
	}
	
})();