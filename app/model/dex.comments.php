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
 * Description of DEXComments
 *
 * @author Leon
 */
class DEXComments extends DEXBaseModel
{
    public $user_auth = null;

    protected function Init()
    {
    }

    public function GetComments($place)
    {
        global $_GDB;
        
        include $this->LoadFile("dex.comments.php");
    }

    public function PrintComment($comment)
    {
        global $_GDB;

        $name = $_GDB->SelectCell('SELECT `name` FROM `users` WHERE `id`=?', $comment['user']);

        echo '<div class="col-md-12 com">';
            echo '<div class="row">';
                echo '<div class="col-md-12"><div class="username">'.$name.'</div></div>';
                echo '<div class="col-md-12"><div class="comment">'.$comment['comment'].'</div></div>';
            echo '</div>';
        echo '</div>';
    }

    // public function PrintComment($id, $offset)
    // {
    //     global $_GDB;

    //     $comment = $_GDB->SelectRow('SELECT * FROM `comments` WHERE `id`=?', $id);
    //     //$user = $this->GetName($_GDB->SelectCell('SELECT `steamID` FROM `auth` WHERE `id`=?', $comment['user']));

    //     echo '<div class="col-md-12 com">';
    //         echo '<div class="row">';

    //             if ($offset >= 12)
    //             {
    //                 echo '<div class="col-md-12"><div class="username">'.$user.'</div></div>';
    //                 echo '<div class="col-md-12"><div class="comment">'.$comment['comment'].'</div></div>';

    //                 $offset--;
    //             }
    //             else if ($offset < 12)
    //             {
    //                 echo '<div class="col-md-'.(12 - $offset).'"></div>';
    //                 echo '<div class="col-md-'.$offset.'">';
    //                     echo '<div class="row">';
    //                         echo '<div class="col-md-12"><div class="username">'.$user.'</div></div>';
    //                         echo '<div class="col-md-12"><div class="comment">'.$comment['comment'].'</div></div>';
    //                     echo '</div>';
    //                 echo '</div>';

    //                 $offset--;

    //                 if ($offset < 6)
    //                 {
    //                     $offset = 6;
    //                 }
    //             }

    //         echo '</div>';
    //     echo '</div>';

    //     $c1 = $_GDB->Select('SELECT * FROM `comments` WHERE `answer`=?', $id);

    //     foreach ($c1 as $value) {
    //         $this->PrintComment($value['id'], $offset);
    //     }
    // }
}