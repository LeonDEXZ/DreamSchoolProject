<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

defined('DEX_INDEX') or die;
!defined('DEX_LANG') or die;

define('DEX_LANG', true);

$_GText = array(
    'error_exists_file' => 'Не найден фаил',
    "error_map_exists" => "Система: Файл карты классов не найден: ",
    "error_class_exists" => "Система: Класс не найден: ",
    "error_file_exists" => "Система: Файл не найден: ",
    "error_map_class_exists" => "Система: Класс в карте не найден: ",
    "message_success_feedback" => "Сообщение отправлено.",
    0 => 'Система: Не указана переменная "view" в ',
    15 => 'База данных: Ошибка подключения',
    16 => 'База данных: Ошибка выбора базы данных "' . $_GConfig['db_database'] . '"',
    17 => 'База данных: Ошибка запроса',
);
