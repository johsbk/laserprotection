<?php
use main\controllers\Index;
use templates\TemplatesConfig;
use main\controllers\Product;

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
