"use strict";

(function() {
	
	function validateNewFooditem(evt) {
		
		evt.preventDefault();
		
		var name = $('input[name="new-fooditem-name"]').get(0).value;
		var description = $('textarea[name="new-fooditem-description"]').get(0).value;
		
		$.ajax("http://recipehub.dev/fooditems",{
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
				
				printFooditem(data.fooditem);
				Store.fooditems.push(data.fooditem);
				returnToListView();
				
			},
			method: "POST"
		});
		
	}
	
	
	
	function printFooditem(fooditem) {
		
		$("#fooditem-list").append(function() {
			
			var el = document.createElement("LI");
			el.innerHTML = fooditem.name;
			el.setAttribute("class","fooditem");
			el.setAttribute("data-item_id",fooditem.id);
			
			return el;
			
		});
		
	}
	
	
	
	function returnToListView(evt) {
		
		$("#form-view").hide();
		$("#create-fooditem-form-container").hide();
		$("#create-fooditem-form").get(0).reset();
		$("#list-view").show();
		
		$("#create-fooditem-form").off("submit");
		$("#create-fooditem-return").off("click");
		
	}
	
	
	
	function createFooditemEvents() {
		
		$("#create-fooditem-form").on("submit",validateNewFooditem);
		$("#create-fooditem-return").on("click",returnToListView);
		
	}
	
	
	
	window.showCreateFooditemForm = function() {
		
		$("#list-view").hide();
		$("#form-view").show();
		$("#create-fooditem-form-container").show();
		createFooditemEvents();
		
	}
	
})();