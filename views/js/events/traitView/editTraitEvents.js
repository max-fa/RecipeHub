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
		
		var name = $('input[name="edit-trait-name"]').get(0).value;
		var description = $('textarea[name="edit-trait-description"]').get(0).value;
		
		$.ajax("http://recipehub.dev/traits",{
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			data: JSON.stringify({
				action: "update",
				trait_id: Store.currentObject.id,
				name: name,
				description: description
			}),
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code,
					why: xhr
				});
				
			},
			success: function(data,status,xhr) {
				
				console.log({
					data: data,
					status: status
				});
				
				Store.currentObject.name = data.trait.name;
				Store.currentObject.description = data.trait.description;
				Store.getTrait(data.trait.id).name = data.trait.name;
				Store.getTrait(data.trait.id).description = data.trait.description;
				$("#trait-title").html(data.trait.name);
				$("#trait-body > p").html(data.trait.description);
				returnToObjectView();
				
			},
			method: "POST"
		});
		
	}
	
	
	
	window.editTraitEvents = function() {
		
		$("#edit-trait-form").on("submit",submitTraitEdit);
		$("#edit-trait-return").on("click",returnToObjectView);
		
	}
	
})();