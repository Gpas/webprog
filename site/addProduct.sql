SET @name = "Testprodukt";
SET @desc = "Testbeschreibung";
SET @price = 10;
SET @category = "pralines";
SET @img = "pralinen.jpg";
SET @lang = "de";
SET @options = "1|2|3";

INSERT INTO products (category, price, img, options) VALUES (@category, @price, @img, @options);
INSERT INTO products_lang (product_id, lang_code, name ,description) VALUES (last_insert_id(), @lang, @name, @desc);

SET @name = "Option 1";
SET @values = "80%|90%|100%";
SET @lang = "de";

INSERT INTO options (opt_values) VALUES (@values);
INSERT INTO options_lang (options_id, lang_code, name) VALUES (last_insert_id(), @lang, @name);