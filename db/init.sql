INSERT INTO users (username,password) VALUES('admin','login'),('max','login');

INSERT INTO fooditems (name,description,username) VALUES('Bread','bready and delicious','admin'),('Brocoli','green and cuniferous,','admin');

INSERT INTO recipes (title,ingredients,instructions,published,user_id) VALUES('sandwich','bread','fill the bread',true,1),
('brocoli & cheese','brocoli and cheese','smother the brocoli in cheese',false,1);

INSERT INTO traits (name,description,username) VALUES('fatty','contains high amounts of fat per serving','admin'),
('cuniferous','anti-cancerous amongs other things','admin'),('bready','converts to sugar','max'),('carbohydraty','like bread but more','max'),
('bushy','like wheat','admin');

INSERT INTO item_traits_mappings (item_id,trait_id) VALUES(1,3),(2,2);

