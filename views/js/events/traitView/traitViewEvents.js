"use strict";

(function() {
	
	function updateListView(id) {
		
		$("#trait-list > li.trait").each(function(index,li) {
			
			if( parseInt(li.getAttribute("data-trait_id"),10) === id ) {
				
				$(this).remove();
				return false;
				
			}
			
		})
		
	}
	
	

	function deleteTrait(evt) {
		
		 document.getElementById("object-view").classList.add("busy");
		
		$.ajax("http://recipehub.dev/traits",{
			contentType: "application/json",
			dataType: "json",
			data: JSON.stringify({
				trait_id: Store.currentObject.id
			}),
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code,
					request: xhr
				});
				
			},
			success: function(data,status,xhr) {
				
				Store.deleteTrait(Store.currentObject.id);
				Store.deleteMappingsByTrait(Store.currentObject.id);
				updateListView(Store.currentObject.id);
				Store.currentObject = null;
				returnToListView();
				document.getElementById("object-view").classList.remove("busy");
				
			},
			method: "DELETE"
		});
		
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