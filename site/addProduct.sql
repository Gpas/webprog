SET @name = "Testprodukt";
SET @desc = "Testbeschreibung";
SET @price = 10;
SET @category = "pralines";
SET @img = "pralinen.jpg";
SET @lang = "de";

SELECT `AUTO_INCREMENT`
FROM  INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = 'web_prog'
AND   TABLE_NAME   = 'products';

INSERT INTO products (category, price, img) VALUES (@category, @price, @img);
INSERT INTO products_lang (product_id, lang_code, name ,description) VALUES (last_insert_id(), @lang, @name, @desc);