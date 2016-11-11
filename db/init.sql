
INSERT INTO fooditems (name,description) VALUES('Bread','bready and delicious'),('Brocoli','green and cuniferous');

INSERT INTO recipes (title,ingredients,instructions) VALUES('sandwich','bread','fill the bread'),
('brocoli & cheese','brocoli and cheese','smother the brocoli in cheese'),
('fried chicken', 'fry and chicken', 'fry the damn bird');

INSERT INTO traits (name,description) VALUES('fatty','contains high amounts of fat per serving'),
('cuniferous','anti-cancerous amongs other things'),('bready','converts to sugar'),('carbohydraty','like bread but more'),
('bushy','like wheat');

INSERT INTO item_traits_mappings (item_id,trait_id) VALUES(1,3),(2,2);

