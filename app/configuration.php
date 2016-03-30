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

$_GConfig['name'] = 'DEX';

$_GConfig['db_enable'] = true;
$_GConfig['db_host'] = 'localhost';
$_GConfig['db_port'] = '3306';
$_GConfig['db_user'] = 'root';
$_GConfig['db_password'] = '';
$_GConfig['db_database'] = 'dreamschool';
$_GConfig['db_encoding'] = 'utf8';

$_GConfig['def_controller'] = 'dreamschool';

$_GConfig['tmp_main_file'] = 'DreamSchool/main_tmp.php';

$_GConfig['lang'] = 'ru'; // name lang file php for dir lang