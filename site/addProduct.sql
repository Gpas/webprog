SET @name = "Testprodukt";
SET @desc = "Testbeschreibung";
SET @price = 10;
SET @category = "pralines";
SET @img = "pralinen.jpg";
SET @lang = "de";

INSERT INTO products (category, price, img) VALUES (@category, @price, @img);
SET @product_id = last_insert_id();
INSERT INTO products_lang (product_id, lang_code, name ,description) VALUES (@product_id, @lang, @name, @desc);

-- Optionen
INSERT INTO prod_opt (prod_id, option_id) VALUES (@product_id, 1);