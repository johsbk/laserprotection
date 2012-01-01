<?php
use main\models\Film;
use templates\mvc\Registry;
use templates\auth\Auth;

$loader = new \Twig_Loader_Filesystem(array(SITE_PATH.'/twigs/',IMPORT_PATH.'twigs/'));
$twig = new \Twig_Environment($loader,array('cache'=>SITE_PATH.'/cache/','debug'=>true));
$twig->addGlobal('URL_PATH', URL_PATH);
$twig->addGlobal('MEDIA_PATH', MEDIA_PATH);
$twig->addGlobal('TEMPLATE_PATH', TEMPLATE_PATH);
$twig->addGlobal('TEMPLATE_MEDIA_PATH', TEMPLATE_MEDIA_PATH);
$twig->addGlobal('request',$_REQUEST);
$twig->addGlobal('loggedin', Auth::isLoggedin());
$twig->addGlobal('session_id',session_id());
function twig_filter_get($obj,$string) {
	return $obj->$string;
}
$twig->addFilter('get', new Twig_Filter_Function('twig_filter_get'));
function twig_function_getArgs($string='') {
	return Functions::getArgs($string);	
}

$twig->addFunction('getArgs', new Twig_Function_Function('twig_function_getArgs'));

function twig_function_include_php ($str) {
	include $str;
}
$twig->addFunction('combobox', new Twig_Function_Function('templates\\form\\ComboBox::display'));
$twig->addFunction('include_php', new Twig_Function_Function('twig_function_include_php'));



Registry::getInstance()->twig = $twig;