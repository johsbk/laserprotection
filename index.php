<?php
use \Exception;
try {	
	date_default_timezone_set('Europe/Paris');
	$route = (isset($_GET['rt']) ? $_GET['rt'] : '');
	unset($_GET['rt']);
	$site_path = realpath(dirname(__FILE__));
	define("SITE_PATH",$site_path);
	$pi = pathinfo($_SERVER['SCRIPT_NAME']);
	$urlpath = $pi['dirname'];
	if ($urlpath=='\\') $urlpath ='';
	define("URL_PATH",$urlpath);
	define("MEDIA_PATH",URL_PATH."/media");
	if (file_exists(SITE_PATH.'/templates')) {
		define("TEMPLATE_PATH",URL_PATH."/templates/");
		define("IMPORT_PATH",SITE_PATH.'/templates/');
		
	} else {
		define("TEMPLATE_PATH",URL_PATH."/../templates/");
		define("IMPORT_PATH",SITE_PATH.'/../templates/');
	}
	define("TEMPLATE_MEDIA_PATH",TEMPLATE_PATH.'media/');
	define("ROOT_PATH",SITE_PATH);
	include('init.php');
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	}
	session_start();
	include('inittwig.php');
	\templates\db\DB::login(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
	$reg = \templates\mvc\Registry::getInstance();
	$reg->template = new \templates\mvc\Template();
	$reg->router = new \templates\mvc\Router();
	
	$reg->starttime = $reg->endtime = microtime(true);
	ob_start();
	$reg->router->loader($route);
	ob_end_flush();
	\templates\db\DB::logout();
}  catch (Exception $e) {
	/* @var $e Exception */
	echo "URL: ".$route."<br />";
	echo "MSG: ".$e->getMessage()."<br />";
	echo 'Backtrace: '.$e->getTraceasstring()."<br />";
}
?>