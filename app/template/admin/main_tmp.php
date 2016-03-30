<?php
if ($_GACO->Name() != 'admin')
    exit;
?>
<!DOCTYPE html>
<!--
Copyright (C) 2015 Leon

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/admin_style.css">
        <!-- Load jQuery  -->
        <script src="js/jquery.min.js"></script>

        <!-- Load WysiBB JS and Theme 
        <script src="js/jquery.wysibb.min.js"></script>
        <link rel="stylesheet" href="css/wbbtheme.css" />-->
        
        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

        <!-- Init WysiBB BBCode editor -->
        <script>
        /*$(document).ready(function() {
            var wbbOpt = {
              buttons: "bold,italic,underline,strike,sup,sub,|,img,video,link,|,bullist,numlist,|,fontcolor,fontsize,fontfamily,|,justifyleft,justifycenter,justifyright",
            }
            $("#editor").wysibb(wbbOpt);
        });*/

        function onClickSandHtml()
        {   
            var editor_data = CKEDITOR.instances.editor1.getData();
            
            $.post("index.php?controller=admin&v=save_page",
                {
                    html_body : editor_data,
                    name : $('#page_name').val()
                },
                function(data){
                    alert("Data Loaded: " + data);
                });

            $('.A11').append(editor_data);
        }
        </script>
    </head>
    <body>
        <header>
            <img src="">
        </header>
        <section>
            <?php
            if ($_GACO->user_admin_auth->IsLogin())
            {
                // show index or v view
            ?>
            <!-- login -->
            <div id="bl-main">
                <nav>
                    <ul>
                        <li>Главная</li>
                        <li>Страници
                            <ul>
                                <?php
                                /*foreach ($_GACO->DATA['view_lists'] as $view_item)
                                {
                                    echo "<li>{$view_item}</li>";
                                }*/
                                ?>
                            </ul>
                        </li>
                        <li>Модули
                            <ul>
                                <?php
                                foreach ($_GModelClassName as $model_item_kay => $model_item_valuew)
                                {
                                    if (file_exists(DEX_MODEL_PATH . '/' . $model_item_valuew['path']))
                                        echo "<li><a href='?controller=admin&model_edit={$model_item_kay}'>{$model_item_valuew['class']}</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="b1-content">
                    <div id='message-box'>
                        <?php
                        foreach ($_GMessages as $message)
                        {
                            if (($message[0] == DEX_MESSAGE_DEBUG && DEX_DEBUG)
                                    || ($message[0] != DEX_MESSAGE_DEBUG))
                            {
                                echo "<div style='margin-bottom: 5px;' id='message-box-{$message[0]}'>{$message[1]}</div>";
                            }
                        }
                        if (!empty($_GMessages))
                        {
                            echo "<br>";
                        }
                        ?>
                    </div>
                    <?php include $_GACO->View(); ?>                    
                </div>
            </div>
            <?php
            }
            else
            {
                // no login show login form
            ?>
            <div id='message-box'>
                <?php
                foreach ($_GMessages as $message)
                {
                    echo "<div style='margin-bottom: 5px;' id='message-box-{$message[0]}'>{$message[1]}</div>";
                }
                if (!empty($_GMessages))
                {
                    echo "<br>";
                }
                ?>
            </div>
            <?php
                include $_GACO->View();
            }
            ?>
        </section>
        <footer>

        </footer>
    </body>
</html>
