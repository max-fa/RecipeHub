"use strict";

(function() {
	
	function returnToObjectView(evt) {
		
		$("#edit-trait-form").off("submit");
		$("#edit-trait-return").off("click");
		
		$("#edit-trait-form-container").hide();
		$("#main-trait-display").show();
		
	}
	
	
	
	function submitTraitEdit(evt) {
		
		evt.preventDefault();
		alert("Read all the data in the form");
		
	}
	
	
	
	window.editTraitEvents = function() {
		
		$("#edit-trait-form").on("submit",submitTraitEdit);
		$("#edit-trait-return").on("click",returnToObjectView);
		
	}
	
})();