<?php

foreach ($_GMessages as $message)
{
    echo "<div class='message {$message[0]}'>{$message[1]}</div>";
}