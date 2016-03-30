<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

/**
 * Description of DEXDreamSchoolController
 *
 * @author Leon
 */

defined('DEX_INDEX') or die;
defined('DEX_BASE_CONTROLLER') or die;

class DSDefController extends DEXBaseController
{   
    public $user_auth = null;
    
    protected function Run()
    {
        $this->user_auth = $this->LoadModel('auth');
        
        if (empty($_GET['m'])) {
            $q = 'general';
        }
        else {
            $q = $_GET['m'];
        }
        
        switch ($q)
        {
            case 'general':
            default:
            {
                $this->PageGeneral();
            }
            break;

            case 'admin':
            {
                $this->PageAdmin();
            }
            break;
        }
    }
    
    private function PageGeneral()
    {
        $this->page_name = 'Главная';     
        $this->view = 'DreamSchool/index_tmp.php';
        
        $this->DATA['news'] = $this->LoadModel('news');
    }
    
    private function PageAdmin()
    {  
        $this->page_name = 'Главная';
        
        $this->view = 'admin/index_tmp.html';
        $this->template = 'admin/main_tmp.php';   

        if (!$this->user_auth->IsLogin())
        {
            $this->view = 'admin/login_form.html';
        }
        else
        {
            if (isset($_GET['v']))
                switch ($_GET['v'])
                {
                    case 'edit_':

                        PushMessage(DEX_MESSAGE_NORMAL, $_POST['bbcode']);

                        break;

                    case 'edit':

                        $this->view = 'admin/edit.php';

                        break;

                    case 'test_bb_convert':

                        $this->view = 'admin/test_bb_convert.php';

                        break;

                    case 'page':

                        $this->view = 'admin/' . ModDownTrim($_GET['p']) . '.php';

                        break;

                    case 'save_page':

                        $this->onAJAX = true;
                        $this->view = 'admin/save_page.php';

                        if (isset($_POST['html_body']))
                        {
                            $name = ModDownTrim($_POST['name']);
                            $name = str_replace(' ', '_', $name);
                            $name = DEX_VIEW_PATH . 'admin/' . $name . '.php';

                            $this->DATA['RSP'] = file_put_contents($name, $_POST['html_body']);
                        }

                        break;

                    default:

                        $this->view = DEX_EMPTY_VIEW;

                        break;
                }
        }
    }
}