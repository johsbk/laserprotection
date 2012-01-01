<?php
use main\models\Film;
use templates\common\Functions;
use cms\helpers\Twig;
use cms\models\Menus;
use templates\mvc\Registry;

require_once IMPORT_PATH.'Twig/Autoloader.php';
include('config.php');

function __autoload($class_name) {
    $filename = $class_name . '.php';
    if (substr($class_name,0,9)=='templates') {
    	$t = str_replace("\\",'/',IMPORT_PATH.substr($filename,10));
    } else {
    	$t = str_replace("\\",'/',SITE_PATH.'/'.$filename);
    }
    if (file_exists($t)) {
    	include($t);
    	return true;
    }
    return \Twig_Autoloader::autoload($class_name);
}