<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

defined('DEX_INDEX') or die;
defined('DEX_BASE_MODEL') or die;

/**
 * Description of base_model
 *
 * @author Leon
 */
class DEXIndexModel extends DEXBaseModel
{
    protected function Init()
    {
        $FilterDataType = array(
            'data' => array(
                'filter' => FILTER_CALLBACK,
                'options' => 'GetQuery'
            )
        );
        $Querys = filter_input_array(INPUT_GET, $FilterDataType);
        
        $this->ReturnDATA['utrtl'] = $Querys['data'];
    }
}
