"use strict";

(function() {
	
	function fetchItem(callbackOne,callbackTwo,id) {
		
		callbackOne(callbackTwo,Store.getFooditem(id));
		
	}
	
	
	
	function fetchTraits(callbackOne,fooditem) {
		
		var traits = Store.getTraits(fooditem.id);
		
		Store.currentObject = Object.assign({traits: traits},fooditem);
		callbackOne();
		
	}
	
	
	
	function showObjectView() {
		
		var fooditem = Store.currentObject;
		
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
			
			var id = parseInt(this.getAttribute("data-item_id"),10);
			fetchItem(fetchTraits,showObjectView,id);
			
		} else {
			
			fetchItem(fetchTraits,showObjectView,evt.data.id);
			
		}
		
	}
	
})();