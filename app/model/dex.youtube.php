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
 * Description of DEXYouTube
 *
 * @author Leon
 */
class DEXYouTube extends DEXBaseModel
{
    private $api_key = 'AIzaSyAFrR_GNn-F-s1JEty-1YOIPP8TY_KbClM';
    private $playlist = 'LL6c6x0RFLfahwTldSJ_8CiQ';

    protected function Init()
    {
    }

    public function GetPlaylistLimit($limit)
    {
        $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet'
        . '&playlistId=' . $this->playlist
        . '&maxResults=' . $limit
        . '&key=' . $this->api_key;

        $buf = file_get_contents($url);
        $json = json_decode($buf);

        //var_dump($json->items);

        $arr = array();

        if (empty($json->items))
            return $arr;

        foreach ($json->items as $value) {
            var_dump($value);
        }

        // foreach ($json['items'] as $v) {
        //     $t = array(
        //         'title' => $v['snippet']['title'], # название
        //         'desc'  => $v['snippet']['description'], # описание
        //         'url'   => $v['snippet']['resourceId']['videoId'], # адрес
        //     );

        //     # изображения
        //     if (isset($v['snippet']['thumbnails'])) {
        //         $t['imgs']['all'] = array();
        //         foreach ($v['snippet']['thumbnails'] as $name => $item) {
        //             $t['imgs']['all'][] = $item['url'];
        //             $wh = $item['width'] . 'x' . $item['height'];
        //             $t['imgs'][$wh][0] = $item['url'];
        //         }
        //     }

        //     $arr[] = $t;
        // }

        return $arr;
    }
}