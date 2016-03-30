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
 * Description of DEXAuthModel
 *
 * @author Leon
 */
class DEXAuthModel extends DEXBaseModel
{
    public $user = array();
    
    private $is_login = false;
    
    public function Init()
    {
        $this->user = array(
            'id' => -1,
            'username' => '',
            'first_name' => '',
            'last_name' => '',
            'password' => '',
            'hash' => ''
        );
        
        if (isset($_COOKIE['auth_hash']))
        {
            if (!$this->AuthHash($_COOKIE['auth_hash']))
            {
                unset($_COOKIE['auth_hash']);
            }
        }
        else
        {
            $username = '';
            $password = '';
        
            if (isset($_POST['username']) && isset($_POST['password']))
            {
                $username = $_POST['username'];
                // protected md5 hash
                $password = md5($_POST['password']);
            }
            else if (isset($_GET['username']) && isset($_GET['password']))
            {
                $username = $_GET['username'];
                // protected md5 hash
                $password = md5($_GET['password']);
            }
            
            if ($username != '' && $password != '')
            {
                if ($this->AuthUserMD5($username, $password) != false)
                {
                    setcookie('auth_hash', $this->user['hash']);
                }
            }
        }
    }
    
    public function GetHash()
    {
        return $this->user['hash'];
    }
    
    public function IsLogin()
    {
        return $this->is_login;
    }
    
    public function AuthHash($hash)
    {
        global $_GDB;
        
        if ($this->IsLogin())
        {
            PushMessage(DEX_MESSAGE_WARNING, 'user auth');
            return;
        }
        
        $auth = $_GDB->SelectRow(
            'SELECT * FROM `auth` WHERE `hash_auth`=?',
            $hash
        );
        
        if ($auth != null)
        {
            if ($auth['ip'] != get_client_ip())
            {
                // log 
            }
            
            $data = $_GDB->SelectRow(
                'SELECT * FROM `users` WHERE `id`=?',
                $auth['user_id']
            );

            $this->user['id'] = $data['id'];
            $this->user['username'] = $data['username'];
            $this->user['first_name'] = $data['first_name'];
            $this->user['last_name'] = $data['last_name'];
            $this->user['password'] = $data['password'];
            $this->user['hash'] = $hash;
            
            $this->is_login = true;
        }
        else
        {
            return false;
        }
        
        return true;
    }
    
    public function AuthUserMD5($username, $password)
    {
        global $_GDB;
        
        $data = $_GDB->SelectRow(
            'SELECT * FROM `users` WHERE `username`=?',
            $username
        );
        
        if ($data != null && md5($data['password']) == $password)
        {
            $this->user['id'] = $data['id'];
            $this->user['username'] = $data['username'];
            $this->user['first_name'] = $data['first_name'];
            $this->user['last_name'] = $data['last_name'];
            $this->user['password'] = $data['password'];      
            $this->user['hash'] = md5($this->user['username'].':'.time());
            
            $this->is_login = true;
            
            $_GDB->Query(
                'INSERT INTO `auth` (`user_id`, `hash_auth`) VALUES (?, ?)',
                $this->user['id'],
                $this->user['hash']
            );

            return $this->user['hash'];
        }
        else
        {
            PushMessage(DEX_MESSAGE_WARNING, 'passwoed no use');
        }
        
        return false;
    }
}
