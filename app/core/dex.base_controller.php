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
    private $name = '';
    protected $onAJAX = false;
    
    public $page_name = '';
    
    protected $IsInit = false;
    protected $view = '';
    protected $template = '';
    protected $model = '';
    
    protected $page_404 = 'view/404.html';
    
    public $DATA = array();
    
    public $isLoadModel = false;
    public $isLoadView = false;
    public $isLoadTemplate = false;
            
    function __construct($name)
    {   
        global $_GConfig;
        
        $this->name = $name;
        $this->view = DEX_EMPTY_VIEW;
        
        $this->Run(); 
        $this->LoadView();
        
        if ($this->template == '')
        {
            $this->template = $_GConfig['tmp_main_file'];
        }
        
        $this->IsInit = true;
    }
    
    public function Name()
    {
        return $this->name;
    }
    
    abstract protected function Run();

    protected function LoadModel($model)
    {
        $obj = LoadClass($model, DEX_MODEL_MAP, DEX_MODEL_PATH);

        return $obj;
        
        // $MData = $_GDB->SelectRow('SELECT * FROM `user_model` WHERE `query`=?',
        //     $model
        // );
        
        // if ($MData['class_name'] == null)
        // {
        //     PushMessage(
        //         DEX_MESSAGE_ERROR,
        //         'error_data_model_exists ' . $this->Name()
        //     );
            
        //     return;
        // }

        // $model_file = DEX_MODEL_PATH . $MData['file_name'];
        
        // if (file_exists($model_file))
        // {
        //     include_once $model_file;
            
        //     if (class_exists($MData['class_name']))
        //     {
        //         $obj = new $MData['class_name']();         
        //         $obj->Init();   
                
        //         $this->DATA['model_' . $model] = $obj;
                
        //         return $obj;
        //     }
        //     else
        //     {
        //         PushMessage(DEX_MESSAGE_ERROR,
        //             'error_model_class_exists ' . $this->Name()
        //         );
        //     }
        // }
        // else
        // {
        //     PushMessage(
        //         DEX_MESSAGE_ERROR,
        //         'error_model_file_exists ' . $this->Name()
        //     );
        // }
        
        return null;
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
            
            $this->view = DEX_VIEW_PATH . '404.html';
        }
    }
    
    public function Template()
    {
        if ($this->template == '')
        {
            PushMessage(
                DEX_MESSAGE_ERROR,
                'template_empty ' . $this->Name()
            );
            
            return DEX_TEMPLATE_PATH . 'ez/main_tmp.php';
        }
        
        if ($this->onAJAX)
        {
            return DEX_TEMPLATE_PATH . 'empty_template.php';
        }
        
        $template_file = DEX_TEMPLATE_PATH . $this->template;
        
        if (file_exists($template_file))
        {    
            return $template_file;
            
            $this->isLoadTemplate = true;
        }
        else
        {
            PushMessage(
                DEX_MESSAGE_ERROR,
                'error_template_file_exists ' . $this->Name()
            );
            
            return DEX_TEMPLATE_PATH . 'ez/main_tmp.php';
        }
    }
}