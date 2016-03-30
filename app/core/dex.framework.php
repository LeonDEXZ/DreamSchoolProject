<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

defined('DEX_INDEX') or die;
defined('DEX_CLASSES_NAME') or die;
defined('DEX_UNIVERSALDATACLASS') or die;
defined('DEX_DATABASE') or die;
defined('DEX_FUNCTION') or die;

define('DEX_CONTROLLER', true);

class DEXFramework extends DEXUniversalDataClass
{
    private $DATA = null;

    function __construct($config)
    {
        parent::__construct($config);
        
        $this->LoadLang();
        
        if ($this->config['db_enable'])
        {
            $this->LoadDataBase();
            
            $this->PushMessages($this->db->TakeMessages());
        }
    }
    
    public function Run()
    {
        $FilterDataType = array(
            'controller' => array(
                'filter' => FILTER_CALLBACK,
                'options' => 'GetQuery'
            )
        );
        $Querys = filter_input_array(INPUT_GET, $FilterDataType);
        
        if ($Querys['controller'] == null)
        {
            $Querys['controller'] = $this->config['def_controller'];
        }
        
        $this->LoadController($Querys['controller']);
        
        // get controller
        if (!is_null($this->DATA))
        {
            $this->PushMessages($this->DATA->TakeMessages());
        }

        if (!is_null($this->message))
        {
            //PreTag($this->message);
        }
    }
    
    private function LoadController($controller)
    {
        $CData = $this->config['controller_class_name'][$controller];
        
        if ($controller == 'ez')
        {
            $controller_file = DEX_EZ_PATH . '/' . $CData['path'];
        }
        else
        {
            $controller_file = DEX_CONTROLLER_PATH . '/' . $CData['path'];
        }
        
        if (file_exists($controller_file))
        { 
            include_once $controller_file;
            
            if (class_exists($CData['class']))
            {
                $this->DATA = new $CData['class'](
                            $this->config, $this->text, $this->db
                        );
                
                $this->DATA->LoadTemplate();
            }
            else
            {
                $this->PushMessage(DEX_MESSAGE_ERROR, 'error_class_exists '.__LINE__);
            }
        }
        else
        {
            $this->PushMessage(DEX_MESSAGE_ERROR, 'error_file_exists '.__LINE__);
        }
    }

    private function LoadLang()
    {
        $text = array();
        
        $lang_file = DEX_LANG_PATH . '/' . $this->config['lang'] . '.php';
        if (file_exists($lang_file))
        {
            include_once $lang_file;
        }
        
        $this->text = $text;
    }
    
    private function LoadDataBase()
    {
        $this->db = new DEXDataBase($this->config, $this->text);
    }
}