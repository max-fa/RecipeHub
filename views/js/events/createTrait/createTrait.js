"use strict";

(function() {
	
	function validateNewTrait(evt) {
		
		evt.preventDefault();
		
		var name = $('input[name="new-trait-name"]').get(0).value;
		var description = $('textarea[name="new-trait-description"]').get(0).value;
		
		$.ajax("http://recipehub.dev/traits",{
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			data: JSON.stringify({
				action: "create",
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
				
				printTrait(data.trait);
				Store.traits.push(data.trait);
				returnToListView();
				
			},
			method: "POST"
		});
		
	}
	
	
	
	function printTrait(trait) {
		
		$("#trait-list").append(function() {
			
			var el = document.createElement("LI");
			el.innerHTML = trait.name;
			el.setAttribute("class","trait");
			el.setAttribute("data-trait_id",trait.id);
			
			return el;
			
		});
		
	}
	
	
	
	function returnToListView(evt) {
		
		$("#form-view").hide();
		$("#create-trait-form-container").hide();
		$("#create-trait-form").get(0).reset();
		$("#list-view").show();
		
		$("#create-trait-form").off("submit");
		$("#create-trait-return").off("click");
		
	}
	
	
	
	function createTraitEvents() {
		
		$("#create-trait-form").on("submit",validateNewTrait);
		$("#create-trait-return").on("click",returnToListView);
		
	}
	
	
	
	window.showCreateTraitForm = function() {
		
		$("#list-view").hide();
		$("#form-view").show();
		$("#create-trait-form-container").show();
		createTraitEvents();
		
	}
	
})();