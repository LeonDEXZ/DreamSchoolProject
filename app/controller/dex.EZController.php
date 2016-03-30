<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

/**
 * Description of ez_controller
 *
 * @author Leon
 */

defined('DEX_INDEX') or die;
defined('DEX_BASE_CONTROLLER') or die;

class DEXEZController extends DEXBaseController
{
    protected function Run()
    {
        $this->template = 'ez/main_tmp.php';
        $this->view = DEX_EMPTY_VIEW;
    }
}