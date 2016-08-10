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
	<script>var SitePath = "<?php echo DEX_SITE_PATH; ?>";</script>

	<meta charset="UTF-8">
	<title><?php echo $this->page_name; ?> - Dream School Project</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<style>body {font-family:sans-serif;}.preloader{position: fixed;z-index:99;top:0;left:0;width:100%;height:100%;background:#191919url(images/preload.gif) center no-repeat;}</style>
	
	<script>!function(e){"use strict";function t(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent&&e.attachEvent("on"+t,n)}function n(t,n){return e.localStorage&&localStorage[t+"_content"]&&localStorage[t+"_file"]===n}function a(t,a){if(e.localStorage&&e.XMLHttpRequest)n(t,a)?o(localStorage[t+"_content"]):l(t,a);else{var s=r.createElement("link");s.href=a,s.id=t,s.rel="stylesheet",s.type="text/css",r.getElementsByTagName("head")[0].appendChild(s),r.cookie=t}}function l(e,t){var n=new XMLHttpRequest;n.open("GET",t,!0),n.onreadystatechange=function(){4===n.readyState&&200===n.status&&(o(n.responseText),localStorage[e+"_content"]=n.responseText,localStorage[e+"_file"]=t)},n.send()}function o(e){var t=r.createElement("style");t.setAttribute("type","text/css"),r.getElementsByTagName("head")[0].appendChild(t),t.styleSheet?t.styleSheet.cssText=e:t.innerHTML=e}var r=e.document;e.loadCSS=function(e,t,n){var a,l=r.createElement("link");if(t)a=t;else{var o;o=r.querySelectorAll?r.querySelectorAll("style,link[rel=stylesheet],script"):(r.body||r.getElementsByTagName("head")[0]).childNodes,a=o[o.length-1]}var s=r.styleSheets;l.rel="stylesheet",l.href=e,l.media="only x",a.parentNode.insertBefore(l,t?a:a.nextSibling);var c=function(e){for(var t=l.href,n=s.length;n--;)if(s[n].href===t)return e();setTimeout(function(){c(e)})};return l.onloadcssdefined=c,c(function(){l.media=n||"all"}),l},e.loadLocalStorageCSS=function(l,o){n(l,o)||r.cookie.indexOf(l)>-1?a(l,o):t(e,"load",function(){a(l,o)})}}(this);</script>
	
	<script>loadCSS( "<?php echo DEX_SITE_PATH; ?>/css/main.min.css", false, "all" );</script>
	<script>loadCSS( "<?php echo DEX_SITE_PATH; ?>/css/fonts.min.css", false, "all" );</script>
	<script>loadCSS( "<?php echo DEX_SITE_PATH; ?>/css/header.min.css", false, "all" );</script>
	
	<script src="<?php echo DEX_SITE_PATH; ?>/js/jquery.min.js"></script>

	<noscript>
		<link rel="stylesheet" href="css/main.min.css">
		<link rel="stylesheet" href="css/fonts.min.css">      
		<link rel="stylesheet" href="css/header.min.css">
	</noscript>

	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src='<?php echo DEX_SITE_PATH; ?>/js/libs.min.js'></script>
	<script src='<?php echo DEX_SITE_PATH; ?>/js/common.js'></script>
</head>
<body>
	<div id="preloader-main"></div>
	<div class="container">
		<div class="main_page">
			<header>
				<div class="row">
					<div class="col-md-6">
						<div class="top-loginbar-socref">
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
					</div>
					<div class="col-md-6 pull-right">
						<div class="top-loginbar-bar">
							<?php if ($this->user_auth->IsLogin()): ?>
								<div class="top-loginbar-bar-name">
									<a href="<?php echo DEX_SITE_PATH; ?>/account"><?php echo $this->user_auth->user["personaname"]; ?></a>
								</div>
								<div class="top-loginbar-bar-img">
									<a href="<?php echo DEX_SITE_PATH; ?>/account"><img src="<?php echo $this->user_auth->user['avatar']; ?>" alt=""></a>
								</div>
								<a href="<?php echo DEX_SITE_PATH; ?>/exit" class="top-loginbar-bar-href">Exit</a>
							<?php else: ?>
								<a href="<?php echo DEX_SITE_PATH; ?>/?login">
									<img src="<?php echo DEX_SITE_PATH; ?>/images/sits_small.png" alt="Steam auth">
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="col-md-12 top-menubar">
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
								<li><a href="#index" id="but-g-index" onClick="event.preventDefault();">ГЛАВНАЯ</a></li>
								<li><a href="#news" id="but-g-news" onClick="event.preventDefault();">НОВОСТИ</a></li>
								<li>
									<a href="#" onClick="event.preventDefault();">УСЛУГИ<i class="fa fa-angle-down top-arrow"></i></a>
									<ul>
										<li><a href="#coach" id="but-g-coach" onClick="event.preventDefault();">Обучение</a></li>
										<li><a href="#commentator" id="but-g-commentator" onClick="event.preventDefault();">Школа комментаторов</a></li>
										<li><a href="#menager" id="but-g-menager" onClick="event.preventDefault();">Менеджер для вашей команды</a></li>
										<li><a href="#boost" id="but-g-boost" onClick="event.preventDefault();">Boost RMM</a></li>
									</ul>
								</li>
								<li><a href="" onClick="event.preventDefault();">ЛИГА</a></li>
								<!-- <li><a href="">БЛОГ</a></li> -->
								<!-- <li><a href="">ТОВАРЫ</a></li> -->
							</ul>
						</nav>
					</div>
				</div>
			</header>

			<section class="row">
				<div class="col-md-12">
					<div class="slider">
						<div id="preloader-slider"></div>
						<div id="slider" class="owl-carousel"></div>
						<div class="owl-controls"></div>
					</div>
				</div>
			</section>

			<section class="row">
				<div class="col-md-12">
					<div class="button-bar">
						<div id="but-g-index" class="main-button">Главная</div>
						<div id="but-g-coach" class="main-button">Обучение</div>
						<div id="but-g-commentator" class="main-button">Школа комментаторов</div>
						<div id="but-g-menager" class="main-button">Менеджер для вашей команды</div>
						<div id="but-g-boost" class="main-button">Boost RMM</div>
					</div>
				</div>
			</section>

			<div class="col-md-12">
				<div id="message-box">
					<?php
					foreach ($_GMessages as $message)
					{
						echo "<div class='message {$message[0]}'>{$message[1]}</div>";
					}
					?>
					<div id="message_new" class='message' style="display: none;"></div>
				</div>
			</div>

			<div class="col-md-12">
				<div id="ajax-container">
					<div id="preloader-page"></div>
					<div id="loader-box"><?php $this->ShowView() ?> </div>     
				</div>
			</div>

			<footer class="row">
				<div class="col-md-12 text-center">Code by <span>DEX</span></div>
			</footer>
		</div>	
	</div>
</body>
</html>
