"use strict";

(function() {
	
	function returnToObjectView(evt) {
		
		$("#edit-fooditem-form").off("submit");
		$("#edit-fooditem-return").off("click");
		
		$("#edit-fooditem-form-container").hide();
		$("#main-fooditem-display").show();
		
	}
	
	
	
	function submitItemEdit(evt) {
		
		evt.preventDefault();
		alert("Read all the data in the form");
		
	}
	
	
	
	window.editItemEvents = function() {
		
		$("#edit-fooditem-form").on("submit",submitItemEdit);
		$("#edit-fooditem-return").on("click",returnToObjectView);
		
	}
	
})();