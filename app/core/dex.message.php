<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

/**
 * Description of message
 *
 * @author Leon
 */

function PushMessage($type, $text)
{
    global $_GMessages;
    
    array_push($_GMessages, array($type, $text));
}

function PushMessages($message)
{
    global $_GMessages;
    
    $this->message = array_merge($_GMessages, $message);
}
