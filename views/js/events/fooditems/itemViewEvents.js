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



	function deleteItem(evt) {
		
		var id = this.getAttribute("data-item-id");
		
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
		alert("Deleting food");
		
	}
	
	
	
	function showEditItemForm(evt) {
		
		$("#main-fooditem-display").css("display","none");
		$("#edit-fooditem-form-container").css("display","block");
		editItemEvents();
		
	}
	
	
	
	function returnToListView(evt) {
		
		$("#delete-fooditem-button").off("click");
		$("#edit-fooditem-button").off("click");
		$("#fooditem-return-button").off("click");
		
		$("#fooditem-title").html("");
		$("#fooditem-body").html("");
		$("#fooditem-traits > li").filter(".fooditem-trait").remove();
		
		$("#list-view").css("display","block");
		$("#object-view").css("display","none");
		$("#fooditem-display").css("display","none");
		
	}
	
	
	
	window.itemViewEvents = function() {
		
		$(".fooditem-trait").on("click",showTrait);
		$("#delete-fooditem-button").on("click",deleteItem);
		$("#edit-fooditem-button").on("click",showEditItemForm);
		$("#fooditem-return-button").on("click",returnToListView);
		
	}
	
})();