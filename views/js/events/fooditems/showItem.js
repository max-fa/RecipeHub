"use strict";

(function() {
	
	/* fetch a recipe from the server and pass it to fetchTraits() */
	function fetchItem(callbackOne,callbackTwo,id) {
		
		$.ajax("http://recipehub.dev/fooditems?action=one&item_id=" + id,{
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
				
				callbackOne(callbackTwo,data.fooditem);
				
			},
			method: "GET"
			
		});
		
	}
	
	
	
	function fetchTraits(callbackOne,fooditem) {
		
		$.ajax("http://recipehub.dev/fooditems?action=traits&item_id=" + fooditem.id,{
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
				
				callbackOne(Object.assign({ traits: data.traits },fooditem));
				
			},
			method: "GET"
		});
		
	}
	
	
	
	/* Recieve the recipe data along with any traits it may have and display it */
	function showObjectView(fooditem) {
		
		$("#list-view").css("display","none");
		$("#object-view").css("display","block");
		$("#fooditem-display").css("display","block");
		
		$("#fooditem-title").html(fooditem.name);
		$("#fooditem-body > p").html(fooditem.description);
		
		fooditem.traits.forEach(function(traitObj,index,traits) {
			
			$("#fooditem-traits").append(function() {
				
				//attach a click handler to these traits and the ingredients above in a separate function
				var el = document.createElement("LI");
				el.innerHTML = traitObj.name;
				el.setAttribute("data-trait-id",traitObj.id);
				el.setAttribute("class","fooditem-trait");
				return el;
				
			});
			
		});
		
		itemViewEvents();
		
	}
	
	
	
	window.showItem = function(evt) {
		
		if( !evt.data ) {
			
			var id = $(this).attr("data-item_id");
			fetchItem(fetchTraits,showObjectView,id);
			
		} else {
			
			fetchItem(fetchTraits,showObjectView,evt.data.id);
			
		}
		
	}
	
})();