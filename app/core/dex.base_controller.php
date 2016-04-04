<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

defined('DEX_INDEX') or die;
define('DEX_BASE_CONTROLLER', true);

function LoadClass($name, $map, $dir, $defreturn = null)
{
    global $_GText;

    $name = ModDownTrim($name);

    $json_content = GetFileContent($map);
    $control = null;
    if ($json_content !== null)
    {
        $control = json_decode($json_content, true);
    }

    if ($control !== null)
    {
        if (isset($control[$name]))
        {
            $r_data = array(
                "class" => $control[$name]['class_name'],
                "path" => $dir . $control[$name]['file_name']
            );

            if (file_exists($r_data["path"]))
            {
                include_once $r_data["path"];

                if (class_exists($r_data["class"]))
                {
                    return new $r_data["class"]($name);
                }
                else {
                    PushMessage(
                        DEX_MESSAGE_ERROR,
                        $_GText['error_class_exists'].$r_data["class"]
                    );
                }
            }
            else {
                PushMessage(
                    DEX_MESSAGE_ERROR,
                    $_GText['error_file_exists'].$r_data["path"]
                );
            }
        } else {
            PushMessage(
                DEX_MESSAGE_ERROR,
                $_GText['error_map_class_exists'].$name
            );
        }
    }
    else {
        PushMessage(
            DEX_MESSAGE_ERROR,
            $_GText['error_map_exists'].$name
        );
    }

    return $defreturn;
}

/**
 * Description of DEXBaseController
 *
 * @author Leon
 */
abstract class DEXBaseController
{
    protected $name = '';
    public $page_name = '';

    protected $onAJAX = false;
    protected $AJAXShow = false;   
    protected $err_404 = false;

    protected $view = '';
    protected $template = '';
    protected $model = '';
    
    public $DATA = array();
            
    function __construct($name)
    {   
        global $_GConfig;
        
        $this->name = $name;
        $this->view = DEX_EMPTY_VIEW;
        
        if ($this->template == '')
        {
            $this->template = $_GConfig['tmp_main_file'];
        }
    }
    
    public function Name()
    {
        return $this->name;
    }
    
    abstract protected function Run();

    protected function LoadModel($model)
    {
        return LoadClass($model, DEX_MODEL_MAP, DEX_MODEL_PATH);
    }
    
    public function View()
    {
        return $this->view;
    }
    
    public function LoadView()
    {
        if ($this->view == '')
        {
            PushMessage(
                DEX_MESSAGE_DEBUG,
                'view_empty ' . $this->Name()
            );
            
            $this->view = DEX_VIEW_PATH . 'ez/index.php';
        }
        
        if ($this->view == DEX_EMPTY_VIEW)
        {
            return;
        }
        
        $view_file = DEX_VIEW_PATH . $this->view;
        
        if (file_exists($view_file))
        {
            $this->view = $view_file;
        }
        else
        {
            PushMessage(
                DEX_MESSAGE_DEBUG,
                "error_view_file_exists FILE=\"{$this->view}\" CLASS=".$this->Name()
            );
            
            $this->err_404 = true;
            $this->view = DEX_VIEW_PATH . '404.html';
        }
    }
    
    public function Template()
    {
        if ($this->onAJAX)
        {
            return DEX_TEMPLATE_PATH . 'empty_template.php';
        }

        if ($this->template == '')
        {
            PushMessage(
                DEX_MESSAGE_ERROR,
                'template_empty ' . $this->Name()
            );
            
            return DEX_TEMPLATE_PATH . 'ez_template.php';
        }
        
        $template_file = DEX_TEMPLATE_PATH . $this->template;
        
        if (file_exists($template_file))
        {
            return $template_file;
        }
        else
        {
            PushMessage(
                DEX_MESSAGE_ERROR,
                'error_template_file_exists ' . $this->Name()
            );
            
            $this->err_404 = true;
            return DEX_TEMPLATE_PATH . 'ez/main_tmp.php';
        }
    }

    public function Build()
    {
        global $_GMessages, $_GDB, $_GText;

        if (isset($_GET['redirect']))
        {
            return;
        }

        if (isset($_GET['ajax']))
        {
            $this->onAJAX = true;

            $this->Run();
            $this->LoadView();

            if ($this->AJAXShow && !$this->err_404)
            {
                include_once $this->view;
            }
      
            return;
        }

        $this->Run(); 
        $this->LoadView();

        include_once $this->Template();
    }

    protected function GetAJAX()
    {
        $return_array = array();
        $args = func_get_args();

        for ($id = 0; $id < count($args); $id++)
        {
            if (isset($_GET[$args[$id]])) {
                $return_array[$args[$id]] = $_GET[$args[$id]];
            }
        }

        if (count($args) !== count($return_array)) {
            return false;
        }

        if (count($return_array) == 1) {
            return $return_array[$args[0]];
        }

        return $return_array;
    }
}