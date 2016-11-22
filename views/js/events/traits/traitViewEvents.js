"use strict";

(function() {

	function deleteTrait(evt) {
		
		var id = this.getAttribute("data-trait_id");
		
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
		alert("Deleting trait");
		
	}
	
	
	
	function showEditTraitForm(evt) {
		
		$("#main-trait-display").hide();
		$("#edit-trait-form-container").show();
		
		editTraitEvents();
		
	}
	
	
	
	function returnToListView(evt) {
		
		$("#delete-trait-button").off("click");
		$("#edit-trait-button").off("click");
		$("#return-button").off("click");
		
		$("#trait-title").html("");
		$("#trait-body > p").html("");
		
		$("#list-view").show();
		$("#object-view").hide();
		$("#trait-display").hide();
		
	}
	
	
	
	window.traitViewEvents = function() {
		
		$("#delete-trait-button").on("click",deleteTrait);
		$("#edit-trait-button").on("click",showEditTraitForm);
		$("#trait-return-button").on("click",returnToListView);
		
	}
	
})();