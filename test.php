<?php
function get_param($name, $default) {
if (isset($_GET[$name]))
return urldecode($_GET[$name]);
else
return $default;
}
function add_param(&$url,$name,$value) {
$sep = strpos($url, '?') !== false ? '&' : '?';
$url .= $sep . $name . "=" . urlencode($value);
return $url;
}
function navigation($language, $pageId) {
$urlBase = $_SERVER['PHP_SELF'];
add_param( $urlBase, "lang", $language);
for ($i = 0; $i <= 5; $i++) {
$url = $urlBase;
add_param( $url, "id", $i);
$class = $pageId == $i ? 'active' : 'inactive';
echo "<a class=\"$class\" href=\"$url\">".__('page')."
$i</a>";
}
}
function content($pageId) {
echo __('content') . " $pageId";
}
function languages($language, $pageId) {
$languages = array('de','fr', 'en');
$urlBase = $_SERVER['PHP_SELF'];
add_param($urlBase, 'id', $pageId);
foreach( $languages as $lang ) {
$url = $urlBase;
$class = $language == $lang ? 'active' : 'inactive';
echo "<a class=\"$class\" href=\"".add_param($url,'lang
', $lang)."\">".strtoupper($lang)."</a>";
}
}
function __($key) {
global $language;
$texts = array(
'page' => array(
'de'=>'Seite',
'fr'=>'Page',
'en'=>'Page'
),
'content' => array(
'de'=>'Willkommen auf der Seite ',
'fr'=>'Bienvenue `ala page ',
'en'=>'Welcome to the page ')
);
if (isset($texts[$key][$language])) {
return $texts[$key][$language];
} else {
return "[$key]";
}
}
$language = get_param('lang', 'de');
$pageId = get_param('id', 0);
?>
<html> <head> /*...*/ </head>
<body>
<nav><span>Navigation</span>
<?php navigation($language, $pageId); ?>
<div id="languages"><?php languages($language, $pageId)?><
/div>
</nav>
<main>
<span>Main Area</span>
<?php content($pageId)?>
</main>
</body>
</html>