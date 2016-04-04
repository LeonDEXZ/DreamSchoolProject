<!DOCTYPE html>
<!--
/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */
-->
<html>
    <head>
        <title>DEX CMS EZ Template</title>
        <meta charset="UTF-8">
    </head>
    <body>      
        <section>
            <div id='message-box'>
                <?php
                foreach ($_GMessages as $message)
                {
                    echo "<div style='margin-bottom: 5px;' id='message-box-{$message[0]}'>{$message[1]}</div>";
                }
                ?>
            </div>
            <?php include $_GACO->View(); ?>
        </section>
        <footer>

        </footer>
    </body>
</html>
