"use strict";

(function() {
	
	function fetchTrait(callbackOne,id) {
		
		callbackOne(Store.getTrait(id));
		
	}
	
	
	
	/* Recieve the recipe data along with any traits it may have and display it */
	function showObjectView(trait) {
		
		$("#list-view").hide();
		$("#object-view").show();
		$("#trait-display").show();
		
		$("#trait-title").html(trait.name);
		$("#trait-body > p").html(trait.description);
		
		Store.currentObject = trait;
		
		traitViewEvents();
		
	}
	
	
	
	window.showTrait = function(evt) {
		
		var id;
		
		if( !evt.data ) {
			
			id = parseInt(this.getAttribute("data-trait_id"),10);
			fetchTrait(showObjectView,id);
			
		} else {
			
			fetchTrait(showObjectView,evt.data.id);
			
		}
		
	}
	
})();