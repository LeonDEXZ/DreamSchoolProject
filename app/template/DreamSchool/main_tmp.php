<!--

/*
 * Copyright (C) 2016 Leonid aka DEX Zharikov
 * Email: leon.zharikov@gmail.com
 * GitHub: https://github.com/LeonDEXZ
 * License: GNU General Public License
 */
 
-->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $this->page_name; ?> - Dream School Project</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <style>body {font-family:sans-serif;}.preloader{position: fixed;z-index:99;top:0;left:0;width:100%;height:100%;background:#191919url(images/preload.gif) center no-repeat;}</style>
    
    <script>!function(e){"use strict";function t(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent&&e.attachEvent("on"+t,n)}function n(t,n){return e.localStorage&&localStorage[t+"_content"]&&localStorage[t+"_file"]===n}function a(t,a){if(e.localStorage&&e.XMLHttpRequest)n(t,a)?o(localStorage[t+"_content"]):l(t,a);else{var s=r.createElement("link");s.href=a,s.id=t,s.rel="stylesheet",s.type="text/css",r.getElementsByTagName("head")[0].appendChild(s),r.cookie=t}}function l(e,t){var n=new XMLHttpRequest;n.open("GET",t,!0),n.onreadystatechange=function(){4===n.readyState&&200===n.status&&(o(n.responseText),localStorage[e+"_content"]=n.responseText,localStorage[e+"_file"]=t)},n.send()}function o(e){var t=r.createElement("style");t.setAttribute("type","text/css"),r.getElementsByTagName("head")[0].appendChild(t),t.styleSheet?t.styleSheet.cssText=e:t.innerHTML=e}var r=e.document;e.loadCSS=function(e,t,n){var a,l=r.createElement("link");if(t)a=t;else{var o;o=r.querySelectorAll?r.querySelectorAll("style,link[rel=stylesheet],script"):(r.body||r.getElementsByTagName("head")[0]).childNodes,a=o[o.length-1]}var s=r.styleSheets;l.rel="stylesheet",l.href=e,l.media="only x",a.parentNode.insertBefore(l,t?a:a.nextSibling);var c=function(e){for(var t=l.href,n=s.length;n--;)if(s[n].href===t)return e();setTimeout(function(){c(e)})};return l.onloadcssdefined=c,c(function(){l.media=n||"all"}),l},e.loadLocalStorageCSS=function(l,o){n(l,o)||r.cookie.indexOf(l)>-1?a(l,o):t(e,"load",function(){a(l,o)})}}(this);</script>
    
    <script>loadCSS( "<?php echo DEX_SITE_PATH; ?>/css/main.min.css", false, "all" );</script>
    <script>loadCSS( "<?php echo DEX_SITE_PATH; ?>/css/fonts.min.css", false, "all" );</script>
    <script>loadCSS( "<?php echo DEX_SITE_PATH; ?>/css/header.min.css", false, "all" );</script>

    <noscript>
        <link rel="stylesheet" href="css/main.min.css">
        <link rel="stylesheet" href="css/fonts.min.css">      
        <link rel="stylesheet" href="css/header.min.css">
    </noscript>

    <script>var SitePath = "<?php echo DEX_SITE_PATH; ?>";</script>
</head>
<body>
    <div id="preloader-main"></div>
    <div class="container main_page" style="display: none;">
        <header>
            <div class="row top-loginbar">
                <div class="col-md-8 top-loginbar-socref">
                    <div class="vk">
                        <a href="" >
                            <i class="fa fa-vk"></i>
                        </a>
                    </div>
                    <div class="youtube">
                        <a href="" >
                            <i class="fa fa-youtube-play"></i>
                        </a>
                    </div>
                    <div class="twitch">
                        <a href="" >
                            <i class="fa fa-twitch"></i>
                        </a>
                    </div>
                    <div class="twitter">
                        <a href="" >
                            <i class="fa fa-twitter"></i>
                        </a>
                    </div>
                </div>
                <div class="pull-right top-loginbar-bar">
                    <?php if ($this->user_auth->IsLogin()) { ?>
                        <div class="top-loginbar-bar-name">
                            <a href="<?php echo DEX_SITE_PATH; ?>/account"><?php echo $this->user_auth->user["personaname"]; ?></a>
                        </div>
                        <div class="top-loginbar-bar-img">
                            <a href="<?php echo DEX_SITE_PATH; ?>/account"><img src="<?php echo $this->user_auth->user['avatar']; ?>" alt=""></a>
                        </div>
                        <a href="<?php echo DEX_SITE_PATH; ?>/exit" class="top-loginbar-bar-href">Exit</a>
                    <?php } else { ?>
                        <a href="<?php echo DEX_SITE_PATH; ?>/?login">
                            <img src="<?php echo DEX_SITE_PATH; ?>/images/sits_small.png" alt="Steam auth">
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="row top-menubar">
                <div class="col-md-2">
                    <div class="top-menubar-img">
                        <a href="<?php echo DEX_SITE_PATH; ?>">
                            <img src="<?php echo DEX_SITE_PATH; ?>/images/logo.png" alt="Dream School Project">
                        </a>
                    </div>          
                </div>
                <div class="col-md-2">
                    <div class="top-menubar-text">
                        <h1>DREAM<br>SCHOOL</h1>
                    </div>
                </div>          
                <div class="col-md-8">
                    <nav id="top-menu" class="top-menubar-menu">
                        <ul class="sf-menu">
                            <li><a href="/">ГЛАВНАЯ</a></li>
                            <li>
                                <a href="">УСЛУГИ<i class="fa fa-angle-down top-arrow"></i></a>
                                <ul>
                                    <li><a href="">TEXT</a></li>
                                    <li><a href="">TEXT</a></li>
                                    <li><a href="">TEXT</a></li>
                                </ul>
                            </li>
                            <li><a href="">ЛИГА</a></li>
                            <li><a href="">НОВОСТИ</a></li>
                            <li><a href="">БЛОГ</a></li>
                            <li><a href="">ТОВАРЫ</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <section class="row slider">
            <div id="preloader-slider"></div>
            <div id="slider" class="owl-carousel"></div>
            <div class="owl-controls"></div>
        </section>
        <div class="row button-bar">
            <div id="but-g-m" class="main-button">Главная</div>
            <div id="but-g-c" class="main-button">Обучение</div>
            <div id="but-g-sc" class="main-button">Школа коментаторов</div>
            <div id="but-g-mfut" class="main-button">Менеджер для вашей команды</div>
            <div id="but-g-boost" class="main-button">Буст ММР</div>
        </div>
        <section id='message-box'>
            <?php
            foreach ($_GMessages as $message)
            {
                echo "<div class='message {$message[0]}'>{$message[1]}</div>";
            }
            ?>
        </section>
        <div id="ajax-container">
            <div id="preloader-page"></div>
            <div id="loader-box"></div>
            <?php /*include $this->View();*/ ?>     
        </div>
        <footer>
            Code by <span>DEX</span>
        </footer>
        <!-- Load Scripts Start -->
        <script>var scr = {"scripts":[
            {"src" : "<?php echo DEX_SITE_PATH; ?>/js/libs.min.js", "async" : false},
            {"src" : "<?php echo DEX_SITE_PATH; ?>/js/common.js", "async" : false}
            ]};!function(t,n,r){"use strict";var c=function(t){if("[object Array]"!==Object.prototype.toString.call(t))return!1;for(var r=0;r<t.length;r++){var c=n.createElement("script"),e=t[r];c.src=e.src,c.async=e.async,n.body.appendChild(c)}return!0};t.addEventListener?t.addEventListener("load",function(){c(r.scripts);},!1):t.attachEvent?t.attachEvent("onload",function(){c(r.scripts)}):t.onload=function(){c(r.scripts)}}(window,document,scr);
        </script>
        <!-- Load Scripts End -->
    </div>
</body>
</html>
