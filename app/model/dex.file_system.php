<?php
/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * email: leon.zharikov@gmail.com
 * git: https://github.com/LeonDEXZ
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('DEX_INDEX') or die;
defined('DEX_BASE_MODEL') or die;

/**
 * Description of file_system
 *
 * @author Leon
 */
class DEXFileSystemModel extends DEXBaseModel
{
    
    public function Init()
    {
        
    }
    
    public function Open()
    {
        
    }
    
    public function GetContentFolder($path)
    {
        
        return $path;
    }
}

class DEX_FS_X_File
{
    
}

class DEX_FS_Folder extends DEX_FS_X_File
{
    
}

class DEX_FS_File extends DEX_FS_X_File
{
    
}