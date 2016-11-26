"use strict";

(function() {
	
	function returnToObjectView(evt) {
		
		$("#associate-fooditem-list > li.trait").remove();
		
		$("#associate-fooditem-list").off("click");
		$("#associate-fooditem-submit").off("click");
		$("#associate-fooditem-return").off("click");
		
		$("#associate-fooditem-view").hide();
		$("#main-fooditem-display").show();
		
	}
	
	
	
	function selectTrait(evt) {
		
		if( this.hasAttribute("data-selected") ) {
			
			$(this).css("color","black");
			this.removeAttribute("data-selected");
			
		} else {
			
			$(this).css("color","green");
			this.setAttribute("data-selected","true");
			
		}
		
		
	}
	
	
	
	function associateFinal() {
		
		var ids = [];
		
		$("#associate-fooditem-list > li.trait[data-selected]").each(function(trait,index) {
			
			ids.push(parseInt(this.getAttribute("data-trait_id"),10));
			
		});
		
		$.ajax("http://recipehub.dev/fooditems",{
			contentType: "text/plain",
			dataType: "json",
			data: JSON.stringify({
				action: "associate_many",
				item_id: Store.currentObject.id,
				traits: ids.join()
			}),
			error: function(xhr,message,code) {
				
				console.log({
					message: message,
					code: code,
					why: xhr.responseText
				});
				
			},
			success: function(data,status,xhr) {
				
				ids.forEach(function(traitId,index,traitIds) {
					
					var trait = Store.getTrait(traitId);
					
					$("#fooditem-traits").append(function() {
						
						var el = document.createElement("LI");
						el.innerHTML = trait.name;
						el.setAttribute("data-trait-id",trait.id);
						el.setAttribute("class","fooditem-trait");
						return el;
						
					});
					
				});
				
				$("#associate-fooditem-list > li.trait").remove();
				
				data.mappings.forEach(function(mapping,index,mappings) {
					
					Store.fooditemRelations.push(mapping);
					
				});
				
				returnToObjectView();
				
			},
			method: "POST"
		});
		
	}
	
	
	
	window.associateFooditemEvents = function() {
		
		$("#associate-fooditem-submit").on("click",associateFinal);
		$("#associate-fooditem-return").on("click",returnToObjectView);
		$("#associate-fooditem-list").on("click",".trait",selectTrait);
		
		var associatedTraits = Store.getRelations({fooditem: true,id: Store.currentObject.id}).map(function(mapping,index,relations) {
			
			return mapping.trait_id;
			
		});
		
		Store.traits.forEach(function(trait,index,traits) {
			
			if( associatedTraits.indexOf(trait.id) === -1 ) {
				
				$("#associate-fooditem-list").append(function() {
					
					var el = document.createElement("LI");
					el.innerHTML = trait.name;
					el.setAttribute("data-trait_id",trait.id);
					el.setAttribute("class","trait");
					return el;
					
				});
				
			}
			
		});
		
	}
	
})();