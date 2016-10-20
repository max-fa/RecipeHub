INSERT INTO users (username,password) VALUES('admin','login'),('max','login');

INSERT INTO fooditems (name,description,user_id) VALUES('Bread','bready and delicious',1),('Brocoli','green and cuniferous,',1);

INSERT INTO recipes (title,ingredients,instructions,published,user_id) VALUES('sandwich','bread','fill the bread',true,1),
('brocoli & cheese','brocoli and cheese','smother the brocoli in cheese',false,1);

INSERT INTO traits (name,description) VALUES('fatty','contains high amounts of fat per serving'),
('cuniferous','anit-cancerous amongs other things'),('bready','converts to sugar');

INSERT INTO item_traits_mappings (item_id,trait_id) VALUES(1,3),(2,2);

