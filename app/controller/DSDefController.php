<?php

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */

/**
 * Description of DEXDreamSchoolController
 *
 * @author Leon
 */

defined('DEX_INDEX') or die;
defined('DEX_BASE_CONTROLLER') or die;

class DSDefController extends DEXBaseController
{   
	public $user_auth = null;
	public $blog_sys = null;
	public $trainer_profile_sys = null;
	public $comments_sys = null;

	protected function Run()
	{
		global $_GText, $_GDB;

		$this->user_auth = $this->LoadModel('steam_auth');

		switch ($this->GetQuery('mod'))
		{
			case 'blog':
			{
				$this->blog_sys = $this->LoadModel('blog');
				$this->view = 'ds_blog_preview.php';

				if ($this->GetQuery('news') !== false)
				{
					$this->DATA['page'] = $this->GetQuery('page');

					if ($this->DATA['page'] === false)
						$this->DATA['page'] = 1;

					if ($this->DATA['page'] < 1)
						$this->DATA['page'] = 1;

					$this->DATA['count'] = $this->blog_sys->GetBlogCount();
					$this->DATA['step'] = 12;
					$this->DATA['link_count'] = ceil($this->DATA['count']/$this->DATA['step']);

					if ($this->DATA['page'] > $this->DATA['link_count'])
						$this->DATA['page'] = $this->DATA['link_count'];

					$this->page_name = 'Новсти';
					$this->view = 'ds_news.php';
					break;
				}


				$this->DATA['id'] = $this->GetQuery('id');
				if ($this->DATA['id'] !== false)
				{
					$this->comments_sys = $this->LoadModel('comments');
					$this->comments_sys->user_auth = $this->user_auth;

					$this->DATA['blog'] = $this->blog_sys->GetBlog($this->DATA['id']);
					
					if ($this->DATA['blog'])
					{
						$this->page_name = $this->DATA['blog']['title'];
						$this->view = 'ds_blog_id.php';
					}
					else {
						$this->view = '404.php';
					}

					break;
				}
			}

			default:
			case 'index':
			{
				$this->page_name = 'Главная';

				$this->blog_sys = $this->LoadModel('blog');
				$this->view = 'ds_index.php';
				
				// $youtube = $this->LoadModel('youtube');
				// $youtube->GetPlaylistLimit(5);

				break;
			}

			case 'slider':
			{
				$this->view = 'ajax_slider.php';	

				break;
			}

			case 'boost':
			{
				$this->page_name = 'Главная';

				$this->trainer_profile_sys = $this->LoadModel('trainer_profile');
				$this->DATA['booster'] = $this->trainer_profile_sys->GetProfileByType(array('booster'));

				$this->view = 'ds_boost.php';		

				break;
			}

			case 'commentator':
			{
				$this->page_name = 'Главная';

				$this->view = 'ds_commentator.php';	

				break;
			}

			case 'menager':
			{
				$this->page_name = 'Главная';

				$this->view = 'ds_menager.php';	

				break;
			}

			case 'coach':
			{
				$this->page_name = 'Главная';

				$this->view = 'ds_coach.php';

				break;
			}

			case 'add_commet':
			{
				if ($this->onAJAX)
				{
					$text = $this->GetQuery('text');
					$place = $this->GetQuery('place');
					
					$text = trim($text);
					$text = strip_tags($text);
					$text = htmlspecialchars($text);

					if ($text !== "" && $place !== "" && $this->user_auth->IsLogin()) {
						// chapcha test
						
						$id = $_GDB->Query('INSERT INTO `comments` (`place`, `comment`, `user`) VALUES(\'?\', \'?\', '.$this->user_auth->user['id'].')', $place, $text);

						$this->comments_sys = $this->LoadModel('comments');
						$this->comments_sys->PrintComment($_GDB->SelectRow('SELECT * FROM `comments` WHERE `id` = ?', $id));
						
						$this->AJAXShow = true;
					}
				}

				break;
			}

			case 'trainer_profile':
			{
				$this->view = '404.php';
				
				$id = (int)$this->GetQuery('id');

				if ($id !== false)
				{
					$this->trainer_profile_sys = $this->LoadModel('trainer_profile');
					$this->comments_sys = $this->LoadModel('comments');
					$this->comments_sys->user_auth = $this->user_auth;
					$this->DATA['profile'] = $this->trainer_profile_sys->GetProfile($id);
					$this->DATA['profile']['full_name'] = $this->DATA['profile']['first_name'].' '.$this->DATA['profile']['nickname'].' '.$this->DATA['profile']['last_name'];

					$this->page_name = $this->DATA['profile']['full_name'];

					if ($this->DATA['profile'] !== null) {
						$this->view = 'ds_trainer_profile.php';
					}
				}

				break;
			}

			case 'feedback':
			{
				$this->AJAXShow = false;
				$this->onShowData = true;
				$this->showData = $_GText['message_success_feedback'];

				$this->AJAXShow = true;

				break;
			}
		}  

		if ($this->onAJAX)
		{
			//
			// AJAX
			//

			$this->AJAXShow = true;
		}
		else
		{
			//$this->user_auth = $this->LoadModel('steam_auth');
			
			//
			// NO AJAX
			//

			// switch ($this->GetQuery('mod'))
			// {
			// 	case 'blog':
			// 	{
					

			// 		break;
			// 	}

			// 	case 'trainer_profile':
			// 	{
			// 		$this->view = '404.php';	
			// 		$id = (int)$this->GetQuery('id');

			// 		if ($id !== false)
			// 		{
			// 			$this->trainer_profile_sys = $this->LoadModel('trainer_profile');
			// 			$this->DATA['profile'] = $this->trainer_profile_sys->GetProfile($id);

			// 			if ($this->DATA['profile'] !== null) {
			// 				$this->view = 'ds_trainer_profile.php';
			// 			}
			// 		}

			// 		break;
			// 	}

			// 	default:
			// 	{
			// 		$this->user_auth = $this->LoadModel('steam_auth');

			// 		$this->page_name = 'Главная';     
			// 		$this->view = 'ds_index.php';

			// 		$this->blog_sys = $this->LoadModel('blog');

			// 		break;
			// 	}
			// } 

			// END
		}
	}
}