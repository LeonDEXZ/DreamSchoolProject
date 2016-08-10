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
class DEXSteamAuthModel extends DEXBaseModel
{
    private $_STEAMAPI = "A6F4A02E594B56635252B1A959E19566";

    public $user = array();
    private $is_login = false;

    protected function Init()
    {
        global $_GDB;

        if (isset($_COOKIE['auth_hash']))
        {
            if (isset($_GET['exit']))
            {
                $auth = $_GDB->SelectRow(
                    "SELECT * FROM `auth` WHERE `hash_auth`='?'",
                    $_COOKIE['auth_hash']
                );

                if ($auth) {
                    $_GDB->Query(
                        "DELETE FROM `auth` WHERE `hash_auth`='?' LIMIT 1",
                        $_COOKIE['auth_hash']
                    );
                }

                setcookie('auth_hash', "");
                header('Location: ' . DEX_SITE_PATH);
            }
            else {
                if (!$this->AuthHash($_COOKIE['auth_hash']))
                {
                    setcookie('auth_hash', "");
                }
            }        
        }
        else {
            $this->Login();
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
            "SELECT * FROM `auth` WHERE `hash_auth`='?'",
            $hash
        );

        /// =================================================
        //$auth = false;
        /// =================================================
        
        if ($auth)
        {
            if ($auth['ip'] != get_client_ip())
            {
                // log 
                // exit
            }

            $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={$this->_STEAMAPI}&steamids={$auth['steamID']}";
            $json_object = file_get_contents($url);
            $json_decoded = json_decode($json_object);
            $player = $json_decoded->response->players[0];

            $this->user['ip'] = $auth['ip'];
            $this->user['steamID'] = $auth['steamID'];
            $this->user['personaname'] = $player->personaname;
            $this->user['avatar'] = $player->avatar;
            $this->user['avatarmedium'] = $player->avatarmedium;
            $this->user['avatarfull'] = $player->avatarfull;
            $this->user['hash'] = $hash;
            
            $this->is_login = true;

            // REGISTER            
            $user_id = $_GDB->SelectCell(
                'SELECT `id` FROM `users` WHERE `steamID`=?',
                $this->user['steamID']
            );

            if ($user_id === null)
            {
                $user_id = $_GDB->Query(
                    "INSERT INTO `users` (`name`, `steamID`) VALUES ('?', ?)",
                    $player->personaname,
                    $this->user['steamID']
                );
            }

            $this->user['id'] = $user_id;

            return true;
        }
        else {
            setcookie('auth_hash', "");
        }
        
        return false;
    }

    protected function Login()
    {
        global $_GDB;

        try
        {
            include_once DEX_INCLUDE_PATH.'lightopenid/openid.php';

            $openid = new LightOpenID(DEX_SITE_PATH);

            if (!$openid->mode) 
            {
                if (isset($_GET['login'])) 
                {
                    $openid->identity = 'http://steamcommunity.com/openid/?l=english'; 
                    header('Location: ' . $openid->authUrl());
                    exit;
                }
            }
            elseif ($openid->mode == 'cancel') 
            {
                PushMessage(
                    DEX_MESSAGE_WARNING,
                    'User has canceled authentication!'
                );
            }
            else 
            {
                if ($openid->validate()) 
                {
                    $id = $openid->identity;
                    $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                    preg_match($ptn, $id, $matches);

                    $this->user['steamID'] = $matches[1];
                    $this->user['hash'] = md5($this->user['steamID'].':'.time());         

                    setcookie('auth_hash', $this->user['hash']);

                    $_GDB->Query(
                        "INSERT INTO `auth` (`ip`, `hash_auth`, `steamID`) VALUES ('?', '?', ?)",
                        get_client_ip(),
                        $this->user['hash'],
                        $this->user['steamID']
                    );

                    $this->AuthHash($this->user['hash']);

                    header('Location: ' . DEX_SITE_PATH);
                } 
                else 
                {
                    PushMessage(
                        DEX_MESSAGE_WARNING,
                        'User is not logged in.'
                    );
                }
            }
        }
        catch(ErrorException $e) 
        {
            PushMessage(
                DEX_MESSAGE_ERROR,
                $e->getMessage()
            );
        }
    }
}