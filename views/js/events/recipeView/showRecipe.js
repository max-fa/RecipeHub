"use strict";

(function() {
	
	function fetchRecipe(callbackOne,callbackTwo,id) {
		
		callbackOne(callbackTwo,Store.getRecipe(id));
		
	}
	
	
	
	/* fetch all traits that could be associated with a recipe's ingredients and pass the recipe and it's traits to showObjectView() */
	function fetchTraits(callbackOne,recipe) {
		
		/* $.ajax("http://recipehub.dev/fooditems?action=traits&names=" + recipe.ingredients,{
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
				
				Store.currentObject = Object.assign({traits: data.traits},recipe);
				callbackOne();
				
			},
			method: "GET"
		}); */
		
		var traits = recipe.ingredients.split(",").map(function(ingredient,index,ingredients) {
			
			var fooditem = Store.getFooditem(ingredient);
			
			if( fooditem ) {
				
				return Store.getTraits(fooditem.id);
				
			}
			
		}).filter(function(traits,index,traitsArray) {
			
			if( traits === undefined ) {
				
				return false;
				
			} else {
				
				return true;
				
			}
			
		}).flatten();
		
		Store.currentObject = Object.assign({traits: traits},recipe);
		
		callbackOne();
		
	}
	
	
	
	/* Recieve the recipe data along with any traits it may have and display it */
	function showObjectView() {
		
		var recipe = Store.currentObject;
		
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
		
		var id = parseInt(this.getAttribute("data-recipe_id"),10);
		fetchRecipe(fetchTraits,showObjectView,id);
		
	}
	
})();