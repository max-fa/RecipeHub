"use strict";

$(document).ready(function() {
	
	function frontPageEvents() {
		
		$("#search").on("input",function(evt) {
			
			console.log("Change in search box");
			console.log(evt);
			console.log(this);
			
		});
		
		$("#create-recipe-button").on("click",showCreateRecipeForm);
		$("#create-fooditem-button").on("click",showCreateFooditemForm);
		$("#create-trait-button").on("click",showCreateTraitForm);
		
		$("#recipe-list").on("click",".recipe",showRecipe);
		$("#fooditem-list").on("click",".fooditem",showItem);
		$("#trait-list").on("click",".trait",showTrait);
		
	}
	
	
	
	function initLoadRecipes(callbackOne,callbackTwo,callbackThree,callbackFour) {
		
		$.ajax("http://recipehub.dev/recipes?action=many",{
			contentType: "text/plain",
			dataType: "json",
			cache: false,
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
				
				data.recipes.forEach(function(recipe,index,recipes) {
					
					$("#recipe-list").append(function() {
						
						var el = document.createElement("LI");
						el.setAttribute("data-recipe_id",recipe.id);
						el.setAttribute("class","recipe");
						el.innerHTML = recipe.title;
						return el;
						
					});
					
				});
				
				Store.recipes = data.recipes;
				
				callbackOne(callbackTwo,callbackThree,callbackFour);
				
			},
			method: "GET"
			
		});
	}
		
		
		
	function initLoadItems(callbackOne,callbackTwo,callbackThree) {
		
		$.ajax("http://recipehub.dev/fooditems?action=many",{
			contentType: "text/plain",
			dataType: "json",
			cache: false,
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
				
				data.fooditems.forEach(function(item,index,items) {
					
					$("#fooditem-list").append(function() {
						
						var el = document.createElement("LI");
						el.setAttribute("data-item_id",item.id);
						el.setAttribute("class","fooditem");
						el.innerHTML = item.name;
						return el;
						
					});
					
				});
				
				Store.fooditems = data.fooditems;
				
				callbackOne(callbackTwo,callbackThree);
				
			},
			method: "GET"
			
		});
	}
		
		
		
	function initLoadTraits(callbackOne,callbackTwo) {
		
		$.ajax("http://recipehub.dev/traits?action=many",{
			contentType: "text/plain",
			dataType: "json",
			cache: false,
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
				
				data.traits.forEach(function(trait,index,traits) {
					
					$("#trait-list").append(function() {
						
						var el = document.createElement("LI");
						el.setAttribute("data-trait_id",trait.id);
						el.setAttribute("class","trait");
						el.innerHTML = trait.name;
						return el;
						
					});
					
				});
				
				Store.traits = data.traits;
				
				callbackOne(callbackTwo);
				
			},
			method: "GET"
			
		});
		
	}
	
	
	
	function initLoadRelations(callbackOne) {
		
		$.ajax("http://recipehub.dev/relations",{
			contentType: "text/plain",
			dataType: "json",
			cache: false,
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
				
				Store.fooditemRelations = data.relations;
				callbackOne();
				
			},
			method: "GET"
			
		});
		
	}
	
	initLoadRecipes(initLoadItems,initLoadTraits,initLoadRelations,frontPageEvents);
	
});
	