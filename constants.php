<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/3/2017
 * Time: 8:03 PM
 */
#define('DS', DIRECTORY_SEPARATOR);
define("ROOT_DIR",__DIR__.DIRECTORY_SEPARATOR); // Root Directory
define("__ROOT__",realpath(dirname(__FILE__)));
define("ROOT_REAL_PATH",str_replace('\\','/',realpath(__DIR__)));
define("BASEPATHXADMIN",'http://localhost/ladylike/xadmin'); // Xadmin Path
#define("JS",ROOT_DIR.'js'.DS); // Js Path
//define('CORE',ROOT_DIR.'core'.DS); // Core PHP function Path
//
define('CORE',"http://localhost/ladylike/core"); // Core PHP function Path
/*define("ASSESTS",ROOT_DIR.'assests'.DS); // Assests Path*/

define("ASSESTS","http://localhost/ladylike/assests"); // Assests Path
define("JS","http://localhost/ladylike/js");
define("IMAGES","http://localhost/ladylike/images");

define("UPLOAD","http://localhost/ladylike/xadmin/upload/");




define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);
define('UPLOADPATH',$_SERVER['DOCUMENT_ROOT']."/ladylike/");


define("UPLOADPATHXADMIN",$_SERVER['DOCUMENT_ROOT']."/ladylike/xadmin/upload/");

// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
//define("ROOT_DIR",dirname(__DIR__). DIRECTORY_SEPARATOR); // Root Directory
/*
define("ROOT_DIR",__DIR__. DIRECTORY_SEPARATOR); // Root Directory
define("__ROOT__",realpath(dirname(__FILE__)));
define("ROOT_REAL_PATH",str_replace('\\','/',realpath(__DIR__)));
define("BASEPATHXADMIN",'localhost/ladylike/xadmin'); // Xadmin Path
define("JS",'localhost/ladylike/js'); // Js Path
define('CORE','localhost\ladylike\core'.DIRECTORY_SEPARATOR); // Core PHP function Path
define("ASSESTS",'localhost/ladylikeladylike/assests/xadmin/'); // Assests Path*/