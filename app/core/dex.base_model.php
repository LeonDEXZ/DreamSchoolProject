<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

defined('DEX_INDEX') or die;

define('DEX_BASE_MODEL', true);

/**
 * Description of base_model
 *
 * @author Leon
 */
abstract class DEXBaseModel
{
    protected $name = '';
    protected $IsInit = false;
    protected $ReturnDATA = array(
        'view' => null
    );
            
    function __construct($name)
    {
        $this->Init();
        $this->IsInit = true;
        $this->name = $name;
    }

    public function Name()
    {
        return $this->name;
    }
    
    protected abstract function Init();
    
    public function GetReturnDATA()
    {
        if ($this->IsInit)
        {
            return $this->ReturnDATA;
        }
    }

    protected function LoadFile($file)
    {
        $view_file = DEX_VIEW_PATH . $file;

        if (file_exists($view_file))
        {
            return $view_file;
        }
        else
        {
            PushMessage(
                DEX_MESSAGE_DEBUG,
                "error_DEXBaseModel_ShowFile_file_exists FILE=\"{$view_file}\" CLASS=".$this->Name()
            );
        }

        return null;
    }
}