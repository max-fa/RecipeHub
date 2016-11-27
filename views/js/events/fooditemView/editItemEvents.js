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
		
		var name = $('input[name="edit-fooditem-name"]').get(0).value;
		var description = $('textarea[name="edit-fooditem-description"]').get(0).value;
		
		$.ajax("http://recipehub.dev/fooditems",{
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			data: JSON.stringify({
				action: "update",
				item_id: Store.currentObject.id,
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
				
				Store.currentObject.name = data.fooditem.name;
				Store.currentObject.description = data.fooditem.description;
				Store.getFooditem(data.fooditem.id).name = data.fooditem.name;
				Store.getFooditem(data.fooditem.id).description = data.fooditem.description;
				$("#fooditem-title").html(data.fooditem.name);
				$("#fooditem-body > p").html(data.fooditem.description);
				returnToObjectView();
				
			},
			method: "POST"
		});
		
	}
	
	
	
	window.editItemEvents = function() {
		
		$("#edit-fooditem-form").on("submit",submitItemEdit);
		$("#edit-fooditem-return").on("click",returnToObjectView);
		
	}
	
})();