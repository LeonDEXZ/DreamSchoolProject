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
