"use strict";

(function() {
	
	Array.prototype.flatten = function() {
		
		/* base formula for flattening arrays:
		
		arr.reduce(function(prev,cur,index,array) {
			
			cur.forEach(function(num,index,nums) {
				
				prev.push(num);
				
			});
			return prev;
		
		},[]); */
		
		return this.reduce(function(previous,current,index,array) {
			
			current.forEach(function(val,index,vals) {
				
				previous.push(val);
				
			});
			
			return previous;
			
		},[]);
		
	}
	
	window.Store = {
		
		currentObject: {},
		
		traits: [],
		
		recipes: [],
		
		fooditems: [],
		
		fooditemRelations: [],
		
		getRecipe: function(selector) {
			
			return this.recipes.filter(function(recipe,index,recipes) {
				
				if( recipe.id === selector ) {
					
					return true;
					
				} else {
					
					return false;
					
				}
				
			})[0];
			
		},
		
		deleteRecipe: function(id) {
			
			var index = Store.recipes.findIndex(function(recipe,index,recipes) {
				
				if( recipe.id === id ) {
					
					return true;
					
				}
				
			});
			
			var removed = this.recipes.splice(index,1);
			
			if( removed.length > 0 ) {
				
				return true;
				
			} else {
				
				return false;
			}
			
		},
		
		getFooditem: function(selector) {
			
			if( typeof selector === "string" ) {
				
				return this.fooditems.filter(function(fooditem,index,fooditems) {
					
					if( fooditem.name === selector ) {
						
						return true;
						
					} else {
						
						return false;
						
					}
					
				})[0];
				
			} else {
				
				return this.fooditems.filter(function(fooditem,index,fooditems) {
					
					if( fooditem.id === selector ) {
						
						return true;
						
					} else {
						
						return false;
						
					}
					
				})[0];
				
			}
			
		},
		
		deleteFooditem: function(id) {
			
			var index = Store.fooditems.findIndex(function(fooditem,index,fooditems) {
				
				if( fooditem.id === id ) {
					
					return true;
					
				}
				
			});
			
			var removed = this.fooditems.splice(index,1);
			
			if( removed.length > 0 ) {
				
				return true;
				
			} else {
				
				return false;
			}
			
		},
		
		getTrait: function(selector) {
			
			if( typeof selector === "string" ) {
				
				return this.traits.filter(function(trait,index,traits) {
					
					if( trait.name === selector ) {
						
						return true;
						
					} else {
						
						return false;
						
					}
					
				})[0];
				
			} else {
				
				return this.traits.filter(function(trait,index,traits) {
					
					if( trait.id === selector ) {
						
						return true;
						
					} else {
						
						return false;
						
					}
					
				})[0];
				
			}
			
		},
		
		deleteTrait: function(id) {
			
			var index = Store.traits.findIndex(function(trait,index,traits) {
				
				if( trait.id === id ) {
					
					return true;
					
				}
				
			});
			
			var removed = this.traits.splice(index,1);
			
			if( removed.length > 0 ) {
				
				return true;
				
			} else {
				
				return false;
			}
			
		},
		
		getTraits: function(fooditemId) {
			
			return this.fooditemRelations.filter(function(mapping,index,relations) {
				
				if( mapping.item_id === fooditemId ) {
					
					return true;
					
				} else {
					
					return false;
					
				}
				
			}).map(function(mapping,index,relations) {
				
				return mapping.trait_id;
				
			}).map(function(id,index,ids) {
				
				return this.getTrait(id);
				
			},this);
			
		},
		
		getRelations: function(selector) {
			
			if( selector.fooditem ) {
				
				return this.fooditemRelations.filter(function(mapping,index,relations) {
					
					if( mapping.item_id === selector.id ) {
						
						return true;
						
					} else {
						
						return false;
						
					}
					
				});
				
			} else {
				
				return this.fooditemRelations.filter(function(mapping,index,relations) {
					
					if( mapping.trait_id === selector.id ) {
						
						return true;
						
					} else {
						
						return false;
						
					}
					
				});
				
			}
			
		},
		
		deleteMappingsByTrait: function(id) {
			
			var removed;
			
			Store.fooditemRelations.forEach(function(mapping,index,mappings) {
				
				if( mapping.trait_id === id ) {
					
					removed = this.fooditemRelations.splice(index,1);
					
					if( removed.length > 0 ) {
						
						removed = true;
						
					} else {
						
						removed = false;
					}
					
				}
				
			},Store);
			
			if( removed ) {
				
				return true;
				
			} else {
				
				return false;
				
			}
			
		},
		
		deleteMappingsByFooditem: function(id) {
			
			var removed;
			
			Store.fooditemRelations.forEach(function(mapping,index,mappings) {
				
				if( mapping.item_id === id ) {
					
					var removed = this.fooditemRelations.splice(index,1);
					
					if( removed.length > 0 ) {
						
						removed = true;
						
					} else {
						
						removed = false;
					}
					
				}
				
			},Store);
			
			if( removed ) {
				
				return true;
				
			} else {
				
				return false;
				
			}
			
		}
		
	};
	
})();