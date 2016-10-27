DELETE FROM recipes;
DELETE FROM item_traits_mappings;
DELETE FROM fooditems;
DELETE FROM traits;
DELETE FROM users;

ALTER SEQUENCE fooditems_id_seq RESTART WITH 1;
ALTER SEQUENCE recipes_id_seq RESTART WITH 1;
ALTER SEQUENCE traits_id_seq RESTART WITH 1;
ALTER SEQUENCE users_id_seq RESTART WITH 1;