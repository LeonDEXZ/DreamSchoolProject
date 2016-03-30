<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

if (version_compare(PHP_VERSION, '5.4.0', '<'))
{
	die('Your host needs to use PHP 5.4.0 or higher to run this version site');
}

//Var
$_GMessages = array();
$_GText = array();
$_GLang = array();
$_GDB = null;
$_GQuerys = array();
$_GDefController  = null;
$_GACO  = null;

define('DEX_DEBUG', true);

define('DEX_INDEX', true);
// define('DEX_BASE_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/');
define('DEX_BASE_PATH', '');
define('DEX_CORE_PATH', DEX_BASE_PATH . 'core/');

include_once DEX_CORE_PATH . 'dex.defines.php';
include_once DEX_BASE_PATH . 'configuration.php';
include_once DEX_CORE_PATH . 'dex.message.php';

// load lang
$_GLang['file'] = DEX_LANG_PATH . $_GConfig['lang'] . '.php';
if (!file_exists($_GLang['file']))
{
	$_GLang['file'] = DEX_LANG_PATH . 'ru.php';
}

include_once $_GLang['file'];

include_once DEX_CORE_PATH . 'dex.function.php';
include_once DEX_CORE_PATH . 'dex.base_controller.php';
include_once DEX_CORE_PATH . 'dex.base_model.php';
include_once DEX_CORE_PATH . 'dex.database.php';
include_once DEX_EZ_CONTROLLER_PATH;

// load
$_GDB = new DEXDataBase();
$_GDefController = DEX_EZ_CONTROLLER_CLASS_NAME;
$_GDefController = new $_GDefController("EZ");
$_GDefController = LoadClass(
	$_GConfig['def_controller'],
	DEX_CONTROLLER_MAP,
	DEX_CONTROLLER_PATH
);

// init querys
if (isset($_GET['redirect']))
{
	exit;
}

if (isset($_GET['controller']))
{
	$_GACO = LoadClass(
		$_GET['controller'],
		DEX_CONTROLLER_MAP,
		DEX_CONTROLLER_PATH,
		$_GDefController
	); 
}
else {
	$_GACO = LoadClass(
		$_GConfig['def_controller'],
		DEX_CONTROLLER_MAP,
		DEX_CONTROLLER_PATH,
		$_GDefController
	);  
}

include_once $_GACO->Template();
?>