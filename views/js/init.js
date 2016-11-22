"use strict";

(function() {
	
	function frontPageEvents() {
		
		$("#search").on("input",function(evt) {
			
			console.log("Change in search box");
			console.log(evt);
			console.log(this);
			
		});
		
		
		
		$("#create-recipe-button").on("click",function(evt) {
			
			console.log("Click on create recipe button");
			console.log(evt);
			console.log(this);
			
		});
		
		
		
		$("#create-fooditem-button").on("click",function(evt) {
			
			console.log("Click on create fooditem button");
			console.log(evt);
			console.log(this);
			
		});
		
		
		
		$("#create-trait-button").on("click",function(evt) {
			
			console.log("Click on create trait button");
			console.log(evt);
			console.log(this);
			
		});
		
		
		
		$(".recipe").on("click",showRecipe);
		$(".fooditem").on("click",showItem);
		$(".trait").on("click",showTrait);
		
	}
	
	
	
	function initLoadRecipes(callbackOne,callbackTwo,callbackThree) {
		
		$.ajax("http://recipehub.dev/recipes?action=many",{
			contentType: "text/plain",
			dataType: "json",
			cache: false,
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code
				});
				
			},
			success: function(data,status,xhr) {
				
				console.log({
					data: data,
					status: status
				});
				
				data.recipes.map(function(recipe,index,recipes) {
					
					$("#recipe-list").append(function() {
						
						var el = document.createElement("LI");
						el.setAttribute("data-recipe_id",recipe.id);
						el.setAttribute("class","recipe");
						el.innerHTML = recipe.title;
						return el;
						
					});
					
				});
				
				callbackOne(callbackTwo,callbackThree);
				
			},
			method: "GET"
			
		});
	}
		
		
		
	function initLoadItems(callbackOne,callbackTwo) {
		
		$.ajax("http://recipehub.dev/fooditems?action=many",{
			contentType: "text/plain",
			dataType: "json",
			cache: false,
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code
				});
				
			},
			success: function(data,status,xhr) {
				
				console.log({
					data: data,
					status: status
				});
				
				data.fooditems.map(function(item,index,items) {
					
					$("#fooditem-list").append(function() {
						
						var el = document.createElement("LI");
						el.setAttribute("data-item_id",item.id);
						el.setAttribute("class","fooditem");
						el.innerHTML = item.name;
						return el;
						
					});
					
				});
				
				callbackOne(callbackTwo);
				
			},
			method: "GET"
			
		});
	}
		
		
		
	function initLoadTraits(callbackOne) {
		
		$.ajax("http://recipehub.dev/traits?action=many",{
			contentType: "text/plain",
			dataType: "json",
			cache: false,
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code
				});
				
			},
			success: function(data,status,xhr) {
				
				console.log({
					data: data,
					status: status
				});
				
				data.traits.map(function(trait,index,traits) {
					
					$("#trait-list").append(function() {
						
						var el = document.createElement("LI");
						el.setAttribute("data-trait_id",trait.id);
						el.setAttribute("class","trait");
						el.innerHTML = trait.name;
						return el;
						
					});
					
				});
				
				callbackOne();
				
			},
			method: "GET"
			
		});
		
	}
	
	
	window.init = function() {
		
		initLoadRecipes(initLoadItems,initLoadTraits,frontPageEvents);
		
	}
	
})();