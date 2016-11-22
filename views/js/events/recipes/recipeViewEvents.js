"use strict";

(function() {
	
	function showIngredient(evt) {
		
		/* $.ajax("http://recipehub.dev/fooditems?action=one&name=" + this.innerHTML,{
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
				
				console.log(data);
				
			},
			method: "GET"
		}); */
		console.log(this);
		alert("Showing fooditem");
		
	}
	
	
	
	function showTrait(evt) {
		
		/* $.ajax("http://recipehub.dev/fooditems?action=one&id=" + this.getAttribute("data-trait-id"),{
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
				
				console.log(data);
				
			},
			method: "GET"
		}); */
		console.log(this);
		alert("Showing trait");
		
	}



	function deleteRecipe(evt) {
		
		var id = this.getAttribute("data-recipe-id");
		
		/* $.ajax("http://recipehub.dev/recipes?id=" + id,{
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
				
				if( data.success ) {
					
					console.log("Time to blow this joint");
					
				} else {
					
					console.log("This joint ain't gonna blow");
					
				}
				
			},
			method: "DELETE"
		}); */
		console.log(this);
		console.log(id);
		alert("Deleting recipe");
		
	}
	
	
	
	function showEditRecipeForm(evt) {
		
		$("#main-recipe-display").css("display","none");
		$("#edit-recipe-form-container").css("display","block");
		editRecipeEvents();
		
	}
	
	
	
	function returnToListView(evt) {
		
		//disable all click event listeners on buttons
		$("#delete-recipe-button").off("click");
		$("#edit-recipe-button").off("click");
		$("#return-button").off("click");
		
		//empty out all text
		$("#recipe-title").html("");
		$("#recipe-body > p").html("");
		$("#recipe-ingredients > li").filter(".recipe-ingredient").remove();
		$("#recipe-traits > li").filter(".recipe-trait").remove();
		
		//finally switch the views
		$("#list-view").css("display","block");
		$("#object-view").css("display","none");
		$("#recipe-display").css("display","none");
		
	}
	
	
	
	window.recipeViewEvents = function() {
		
		$(".recipe-ingredient").on("click",showIngredient);
		$(".recipe-trait").on("click",showTrait);
		$("#delete-recipe-button").on("click",deleteRecipe);
		$("#edit-recipe-button").on("click",showEditRecipeForm);
		$("#recipe-return-button").on("click",returnToListView);
		
	}
	
})();