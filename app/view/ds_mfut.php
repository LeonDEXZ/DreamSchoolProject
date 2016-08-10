<section class="row info-boxs">
	<div class="col-md-12 info-box">
		<div class="info-box-title">Менеджер для вашей команды</div>
		<div class="blog-content" style="height: 100%;">
			<div class="subinfo_box">
				У вас есть команда, но вы не знаете, как продвигаться с ней дальше?<br>В этом деле важен профессиональный и серьезный подход - просто предоставьте это нам.
			</div>
			<div class="subinfo_clear_box">
			<b>Менеджер:</b><br>
			<ul>
				<li>Организует и упорядочит ваш режим тренировок.</li>
				<li>Подберет для вас наилучшие варианты турниров, зарегистрирует на них и организует подготовку.</li>
				<li>Займется пиаром вашей команды.</li>
				<li>Предоставит возможность группового обучения у лучших тренеров проекта.</li>
				<li>Предоставит услуги дизайнера для улучшения внешнего вида команды.</li>
				<li>Организует стримы, при желании.</li>
			</ul>
			</div>
			<span class="subinfo_remark">*Стоимость зависит от пакета услуг.<br>*Задать вопросы, узнать стоимость, а так же договориться о тренировках можно, обратившись к администратору.</span>
			<div style="display: -webkit-flex;display: -moz-flex;display: -ms-flex;display: -o-flex;display: flex;">
				<a class="acce-but popup-with-form" href="#test-form">Связаться с администратором</a>
			</div>
			<form id="test-form" class="popup-body mfp-hide">
				<div class="popup-title">Обратная связь</div>
				<fieldset style="border:0;">
					<input id="name" name="name" type="text" placeholder="Как к вам обращаться?" required="" class="text_box">
					<input id="email" name="email" type="email" placeholder="Куда ответить? (VK, E-Mail, Телефон)" required="" class="text_box">
					<textarea id="textarea" name="requests" class="textarea_box" rows="12" placeholder="Ваше пожелание..."></textarea>
					<div class="g-recaptcha" data-sitekey="6LcNEyUTAAAAAPbNDxLSYlJ88G6_uEyTJ27p1G0C" data-callback="onSuccess"></div>
					<div style="display: -webkit-flex;display: -moz-flex;display: -ms-flex;display: -o-flex;display: flex;">
						<a class="acce-but popup-with-form" id="send_msg" href="#test-form">Отправить</a>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		$('.popup-with-form').magnificPopup({
			type: 'inline',
			preloader: false,
			focus: '#name'
		});

		$("#send_msg").click(function(e){
			$.ajax({
				method: "GET",
				url: SitePath + "/index.php",
				dataType: "html",
				data: {
					ajax: "",
					mod: "feedback",
					name: $("#test-form input[name=name]").val(),
					email: $("#test-form input[name=email]").val(),
					requests: $("#test-form textarea[name=requests]").val()
				},
				success: function (data, textStatus) {
					$("#message-box").show();
					$('#message_new').append(data).attr('id','').addClass("normal").slideDown(600);
					$('#message-box').append("<div id=\"message_new\" class='message' style=\"display: none;\"></div>");
				}
			});

			$.magnificPopup.close();

			e.preventDefault();
		});
	});
</script>