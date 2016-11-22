"use strict";

(function() {
	
	function fetchTrait(callbackOne,id) {
		
		$.ajax("http://recipehub.dev/traits?action=one&trait_id=" + id,{
			contentType: "text/plain",
			dataType: "json",
			cache: true,
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code,
					request: xhr
				});
				
			},
			success: function(data,status,xhr) {
				
				callbackOne(data.trait);
				
			},
			method: "GET"
			
		});
		
	}
	
	
	
	/* Recieve the recipe data along with any traits it may have and display it */
	function showObjectView(trait) {
		
		$("#list-view").hide();
		$("#object-view").show();
		$("#trait-display").show();
		
		$("#trait-title").html(trait.name);
		$("#trait-body > p").html(trait.description);
		
		traitViewEvents();
		
	}
	
	
	
	window.showTrait = function(evt) {
		
		var id;
		
		if( !evt.data ) {
			
			id = $(this).attr("data-trait_id");
			fetchTrait(showObjectView,id);
			
		} else {
			
			fetchTrait(showObjectView,evt.data.id);
			
		}
		
	}
	
})();