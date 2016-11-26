"use strict";

(function() {
	
	function returnToObjectView(evt) {
		
		$("#edit-recipe-form").off("submit");
		$("#edit-recipe-return").off("click");
		
		$("#edit-recipe-form-container").css("display","none");
		$("#main-recipe-display").css("display","block");
		
	}
	
	
	
	function submitRecipeEdit(evt) {
		
		evt.preventDefault();
		alert("Read all the data in the form");
		
	}
	
	
	
	window.editRecipeEvents = function() {
		
		$("#edit-recipe-form").on("submit",submitRecipeEdit);
		$("#edit-recipe-return").on("click",returnToObjectView);
		
	}
	
})();