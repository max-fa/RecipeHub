
INSERT INTO fooditems (name,description) VALUES('Bread','bready and delicious'),('Brocoli','green and cuniferous');

INSERT INTO recipes (title,ingredients,instructions) VALUES('Sandwich','Bread,Crust,Fillings,Juice','fill the bread'),
('Brocoli & Cheese','Brocoli,Cheese,Parmalinks','smother the brocoli in cheese'),
('Fried Chicken', 'chicken,flour,spices,oil', 'fry the damn bird');

INSERT INTO traits (name,description) VALUES('fatty','contains high amounts of fat per serving'),
('cuniferous','anti-cancerous amongs other things'),('bready','converts to sugar'),('carbohydraty','like bread but more'),
('bushy','like wheat');

INSERT INTO item_traits_mappings (item_id,trait_id) VALUES(1,3),(2,2);

