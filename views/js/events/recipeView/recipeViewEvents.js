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
	
	
	
	function updateListView(id) {
		
		$("#recipe-list > li.recipe").each(function(index,li) {
			
			if( parseInt(li.getAttribute("data-recipe_id"),10) === id ) {
				
				$(this).remove();
				return false;
				
			}
			
		})
		
	}



	function deleteRecipe(evt) {
		
		document.getElementById("object-view").classList.add("busy");
		
		$.ajax("http://recipehub.dev/recipes",{
			contentType: "application/json",
			dataType: "json",
			data: JSON.stringify({
				recipe_id: Store.currentObject.id
			}),
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code,
					request: xhr
				});
				
			},
			success: function(data,status,xhr) {
				
				Store.deleteRecipe(Store.currentObject.id);
				updateListView(Store.currentObject.id);
				Store.currentObject = null;
				returnToListView();
				document.getElementById("object-view").classList.remove("busy");
				
			},
			method: "DELETE"
		});
		
	}
	
	
	
	function showEditRecipeForm(evt) {
		
		$("#main-recipe-display").css("display","none");
		$("#edit-recipe-form-container").css("display","block");
		editRecipeEvents();
		
	}
	

	
	function returnToListView(evt) {
		
		$("#delete-recipe-button").off("click");
		$("#edit-recipe-button").off("click");
		$("#return-button").off("click");
		
		$("#recipe-title").html("");
		$("#recipe-body > p").html("");
		$("#recipe-ingredients > li").filter(".recipe-ingredient").remove();
		$("#recipe-traits > li").filter(".recipe-trait").remove();
		
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