SET @name = "";
SET @opt_values = "";
SET @prices = "";
SET @lang = "de";
SET @option_id = 3;

INSERT INTO options (options_id, lang_code, name, opt_values, prices) VALUES (@option_id, @lang, @name, @opt_values, @prices);