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
 * Description of DEXBlogModel
 *
 * @author Leon
 */
class DEXBlogModel extends DEXBaseModel
{
    public $blog_count = 0;

    protected function Init()
    {
        global $_GDB;

        $this->blog_count = (int)$_GDB->SelectCell('SELECT COUNT(*) FROM `blog`');
    }

    public function GetBlogsLimit($limit)
    {
        global $_GDB;
        
        if ($limit > $this->blog_count)
        {
            $limit = $this->blog_count;
        }

        return $_GDB->Select('SELECT * FROM `blog` LIMIT ?', $limit);
    }

    public function GetBlog($id)
    {
        global $_GDB;

        if ($id <= $this->blog_count && $id >= 0)
        {
            return $_GDB->SelectRow('SELECT * FROM `blog` WHERE `id`=?', $id);
        }

        return null;
    }

    public function GetBlogCount()
    {
        return $this->blog_count;
    }
}