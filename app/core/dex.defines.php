<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

defined('DEX_INDEX') or die;

// Paths
define('DEX_TEMPLATE_PATH', DEX_BASE_PATH . 'template/');
define('DEX_CONTROLLER_PATH', DEX_BASE_PATH . 'controller/');
define('DEX_MODEL_PATH', DEX_BASE_PATH . 'model/');
define('DEX_VIEW_PATH', DEX_BASE_PATH . 'view/');
define('DEX_LANG_PATH', DEX_BASE_PATH . 'lang/');
define('DEX_IMAGES_PATH', DEX_BASE_PATH . 'images/');
define('DEX_JS_PATH', DEX_BASE_PATH . 'js/');
define('DEX_FONTS_PATH', DEX_BASE_PATH . 'fonts/');
define('DEX_CSS_PATH', DEX_BASE_PATH . 'css/');

// Massage trigger
define('DEX_MESSAGE_NORMAL', 'normal');
define('DEX_MESSAGE_WARNING', 'warning');
define('DEX_MESSAGE_ERROR', 'error');
define('DEX_MESSAGE_DEBUG', 'debug');

// EZ
define('DEX_EMPTY_VIEW', DEX_VIEW_PATH . '/empty_view.php');
define('DEX_EZ_CONTROLLER_PATH', DEX_CONTROLLER_PATH . 'dex.EZController.php');
define('DEX_EZ_CONTROLLER_CLASS_NAME', 'DEXEZController');

define('DEX_CONTROLLER_MAP', DEX_CONTROLLER_PATH."controller.map.json");
define('DEX_MODEL_MAP', DEX_MODEL_PATH."model.map.json");