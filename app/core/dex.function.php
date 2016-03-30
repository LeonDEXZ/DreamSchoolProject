<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

defined('DEX_INDEX') or die;

define('DEX_FUNCTION', true);

function GetFileContent($file)
{
    global $_GText;

    if (file_exists($file))
    {
        return file_get_contents($file);
    }

    PushMessage(DEX_MESSAGE_ERROR, $_GText['error_file_exists'].$file);
    
    return null;
}


function ModDownTrim($q)
{
    return strtolower(trim($q));
}

function PreTag($d)
{
    echo "<pre>" . var_dump($d) . "</pre>";
}

function CreateUlLi()
{
    
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function bbcode_to_html($bbtext)
{
    $bbtags = array(
        '[heading1]' => '<h1>', '[/heading1]' => '</h1>',
        '[heading2]' => '<h2>', '[/heading2]' => '</h2>',
        '[heading3]' => '<h3>', '[/heading3]' => '</h3>',
        '[h1]' => '<h1>', '[/h1]' => '</h1>',
        '[h2]' => '<h2>', '[/h2]' => '</h2>',
        '[h3]' => '<h3>', '[/h3]' => '</h3>',
        '[paragraph]' => '<p>', '[/paragraph]' => '</p>',
        '[para]' => '<p>', '[/para]' => '</p>',
        '[p]' => '<p>', '[/p]' => '</p>',
        '[left]' => '<p style="text-align:left;">', '[/left]' => '</p>',
        '[right]' => '<p style="text-align:right;">', '[/right]' => '</p>',
        '[center]' => '<p style="text-align:center;">', '[/center]' => '</p>',
        '[justify]' => '<p style="text-align:justify;">', '[/justify]' => '</p>',
        '[bold]' => '<span style="font-weight:bold;">', '[/bold]' => '</span>',
        '[italic]' => '<span style="font-weight:bold;">', '[/italic]' => '</span>',
        '[underline]' => '<span style="text-decoration:underline;">', '[/underline]' => '</span>',
        '[b]' => '<span style="font-weight:bold;">', '[/b]' => '</span>',
        '[i]' => '<span style="font-weight:bold;">', '[/i]' => '</span>',
        '[u]' => '<span style="text-decoration:underline;">', '[/u]' => '</span>',
        '[break]' => '<br>',
        '[br]' => '<br>',
        '[newline]' => '<br>',
        '[nl]' => '<br>',
        '[unordered_list]' => '<ul>', '[/unordered_list]' => '</ul>',
        '[list]' => '<ul>', '[/list]' => '</ul>',
        '[ul]' => '<ul>', '[/ul]' => '</ul>',
        '[ordered_list]' => '<ol>', '[/ordered_list]' => '</ol>',
        '[ol]' => '<ol>', '[/ol]' => '</ol>',
        '[list_item]' => '<li>', '[/list_item]' => '</li>',
        '[li]' => '<li>', '[/li]' => '</li>',
        '[*]' => '<li>', '[/*]' => '</li>',
        '[code]' => '<code>', '[/code]' => '</code>',
        '[preformatted]' => '<pre>', '[/preformatted]' => '</pre>',
        '[pre]' => '<pre>', '[/pre]' => '</pre>',
        '[size=50]' => '<span style="font-size: 50;">', '[/size]' => '</span>',
        '[size=85]' => '<span style="font-size: 85;">',
        '[size=100]' => '<span style="font-size: 100;">',
        '[size=150]' => '<span style="font-size: 150;">',
        '[size=200]' => '<span style="font-size: 200;">',
    );
    $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);

    $bbextended = array(
        "/\[url](.*?)\[\/url]/i" => "<a href=\"http://$1\" title=\"$1\">$1</a>",
        //"/\[size=(.*?)\](.*?)\[\/size\]/i" => "<span style=\"text-size: $1;\">$2</span>",
        "/\[url=(.*?)\](.*?)\[\/url\]/i" => "<a href=\"$1\" title=\"$1\">$2</a>",
        "/\[email=(.*?)\](.*?)\[\/email\]/i" => "<a href=\"mailto:$1\">$2</a>",
        "/\[mail=(.*?)\](.*?)\[\/mail\]/i" => "<a href=\"mailto:$1\">$2</a>",
        "/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
        "/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
        "/\[image_left\]([^[]*)\[\/image_left\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_left\" />",
        "/\[image_right\]([^[]*)\[\/image_right\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_right\" />",
    );

    foreach($bbextended as $match => $replacement)
    {
        $bbtext = preg_replace($match, $replacement, $bbtext);
    }

    return $bbtext;
}    