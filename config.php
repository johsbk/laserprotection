<?php
use main\controllers\Index;
use templates\TemplatesConfig;
use main\controllers\Product;

$local = true;
define("MYSQL_USER","debug");
define("MYSQL_PASS","debug");
define("MYSQL_HOST","localhost");
define("MYSQL_DB","laserprotection");

$reg = \templates\mvc\Registry::getInstance();
$reg->installed_apps =array(
	'main',
	'templates.auth',
	'templates.graphs',
);
$reg->urls = array(
	'',
	array('^templates/',TemplatesConfig::urls()),
	array('^index/',Index::$urls),
	array('^$','main.Index.index'),	
);
