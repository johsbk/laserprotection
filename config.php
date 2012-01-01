<?php
use main\controllers\Index;
use templates\TemplatesConfig;
use main\controllers\Product;

define("MYSQL_USER","soyouz");
define("MYSQL_PASS","hejdav");
define("MYSQL_HOST","localhost");
define("MYSQL_DB","laserprotection");
$local = true;

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