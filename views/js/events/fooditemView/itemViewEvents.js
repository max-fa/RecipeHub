"use strict";

(function() {
	
	function showTrait(evt) {
		
		/* $.ajax("http://recipehub.dev/fooditems?action=one&id=" + this.getAttribute("data-trait-id"),{
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
				
				console.log(data);
				
			},
			method: "GET"
		}); */
		console.log(this);
		alert("Showing trait");
		
	}
	
	
	
	function updateListView(id) {
		
		$("#fooditem-list > li.fooditem").each(function(index,li) {
			
			if( parseInt(li.getAttribute("data-item_id"),10) === id ) {
				
				$(this).remove();
				return false;
				
			}
			
		})
		
	}



	function deleteItem(evt) {
		
		document.getElementById("object-view").classList.add("busy");
		
		$.ajax("http://recipehub.dev/fooditems",{
			contentType: "application/json",
			dataType: "json",
			data: JSON.stringify({
				item_id: Store.currentObject.id
			}),
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code,
					request: xhr
				});
				
			},
			success: function(data,status,xhr) {
				
				Store.deleteFooditem(Store.currentObject.id);
				Store.deleteMappingsByFooditem(Store.currentObject.id);
				updateListView(Store.currentObject.id);
				Store.currentObject = null;
				returnToListView();
				document.getElementById("object-view").classList.remove("busy");
				
			},
			method: "DELETE"
		});
		
	}
	
	
	
	function showEditItemForm(evt) {
		
		$("#main-fooditem-display").hide();
		$("#edit-fooditem-form-container").show();
		editItemEvents();
		
	}
	
	
	
	function showAssociateFooditemForm(evt) {
		
		$("#main-fooditem-display").hide();
		$("#associate-fooditem-view").show();
		associateFooditemEvents();
		
	}
	
	
	
	function returnToListView(evt) {
		
		$("#delete-fooditem-button").off("click");
		$("#edit-fooditem-button").off("click");
		$("#fooditem-return-button").off("click");
		$("#associate-fooditem-button").off("click");
		
		$("#fooditem-title").html("");
		$("#fooditem-body > p").html("");
		$("#fooditem-traits > li.fooditem-trait").remove();
		$("#edit-fooditem-form").get(0).reset();
		$("#associate-fooditem-list > li.trait").remove();
		
		$("#list-view").show();
		$("#object-view").hide();
		$("#fooditem-display").hide();
		
	}
	
	
	
	window.itemViewEvents = function() {
		
		$(".fooditem-trait").on("click",showTrait);
		$("#delete-fooditem-button").on("click",deleteItem);
		$("#edit-fooditem-button").on("click",showEditItemForm);
		$("#associate-fooditem-button").on("click",showAssociateFooditemForm);
		$("#fooditem-return-button").on("click",returnToListView);
		
	}
	
})();