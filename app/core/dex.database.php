<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

defined('DEX_INDEX') or die;

define('DEX_DATABASE', true);

class DEXDataBase 
{
	private $link;
	public $connected = false;

	public function __construct()
	{
		global $_GConfig, $_GText;
		
		$this->link = @mysql_connect(
            $_GConfig['db_host'],
            $_GConfig['db_user'],
            $_GConfig['db_password']
		) or PushMessage(DEX_MESSAGE_ERROR, $_GText[15]);

		if ($this->link)
		{
			@mysql_select_db($_GConfig['db_database'])
				or PushMessage(DEX_MESSAGE_ERROR, $_GText[16]);

            $this->Query('SET NAMES ?', $_GConfig['db_encoding']);

            $this->connected = true;
		}
	}

	public function Select()
	{
		if (!$this->link)
			return;
		
		$args = func_get_args();

		return @$this->_select($this->_query($args));
	}

	public function SelectRow()
	{
		if (!$this->link)
			return;
		
		$args = func_get_args();

		$rows = $this->_select($this->_query($args));

		return @$rows[0];
	}

	public function SelectCell()
	{
		if (!$this->link)
			return;
		
		$args = func_get_args();
		$result = $this->_query($args);
		$line = @mysql_fetch_array($result, MYSQL_NUM);

		return @$line[0];
	}

	public function Query()
	{
		if (!$this->link)
			return;
		
		$args = func_get_args();
		return $this->_query($args);
	}

	private function _select($result)
	{
		$rows = array();
		$x = 0;

		while ($line = @mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($line as $key => $value)
			{
				$rows[$x][$key] = $value;
			}

			$x++;
		}

		return $rows;
	}

	private function _query($query)
	{
		global $_GText;
		
		$new_query = '';
		$arr_query = explode('?', $query[0]);
		$y = 1;
		$new_query .= $arr_query[0];

		for ($x = 1; $x <= count($arr_query); $x++)
		{
			if (isset($query[$y]))
			{
				$new_query .= "'" . @mysql_real_escape_string($query[$y++]) . "'";
			}
			if (isset($arr_query[$x]))
			{
				$new_query .= $arr_query[$x];
			}
		}

		$result = @mysql_query($new_query, $this->link);

		if ($result === false)
		{
			PushMessage(DEX_MESSAGE_ERROR, $_GText[17] . ' "' . $new_query . '"');
			return false;
		}

		if (!is_resource($result))
		{
			if (preg_match('/^\s* INSERT \s+/six', $query[0]))
			{
				return @mysql_insert_id($this->link);
			}

			return @mysql_affected_rows($this->link);
		}

		return $result;
	}

}
