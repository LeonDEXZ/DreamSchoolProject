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
 * Description of DSTrainerProfile
 *
 * @author Leon
 */
class DSTrainerProfile extends DEXBaseModel
{
    public $trainer_count = 0;

    protected function Init()
    {
        global $_GDB;

        $this->trainer_count = (int)$_GDB->SelectCell('SELECT COUNT(*) FROM `trainer_profile`');
    }

    public function GetProfileLimit($limit)
    {
        global $_GDB;
        
        if ($limit > $this->trainer_count)
        {
            $limit = $this->trainer_count;
        }

        return $_GDB->Select('SELECT * FROM `trainer_profile` LIMIT ?', $limit);
    }

    public function GetProfile($id)
    {
        global $_GDB;

        if ($id <= $this->trainer_count && $id >= 0)
        {
            return $_GDB->SelectRow('SELECT * FROM `trainer_profile` WHERE `id`=?', $id);
        }

        return null;
    }

    /*
    * in array = 't1', 't2', ...
    */
    public function GetProfileByType($types)
    {
        global $_GDB;

        $return = array();
        foreach ($_GDB->Select('SELECT * FROM `trainer_profile`') as $value)
        {
            $t = explode(',', $value['type']);     

            for ($i = 0; $i < count($t); $i++)
            {
                if (in_array($t[$i], $types)) {
                    array_push($return, $value);
                }
            }
        }

        return $return;
    }

    public function GetTrainerCount()
    {
        return $this->trainer_count;
    }
}