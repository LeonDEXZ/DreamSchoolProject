<section class="row">
	<div class="col-md-12">
		<div class="style_box">
			<div class="row">
				<div class="col-md-12">
					<div class="head text-center">Профессиональные тренеры (обучение)</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="body">
						<div class="coach">
							<div class="box">Здесь вы сможете выбрать себе одного из лучших тренеров В СНГ и начать обучение.</div>
							<div class="box">Тренеры проводят также командные занятия.</div>
							<div class="box">После удачного обучения мы составим рекомендательное письмо и разошлём во множество профессиональных команд и в некоторые организации.</div>

							<div class="row">
								<div class="col-md-12"><p>Само обучение проходит по принципу совмещения теоретических и практических занятий.<br>Каждое занятие будет разделено на несколько частей:</p></div>
								<div class="col-md-12">
									<ul>
										<li><span class="price">1</span> часть: Тренер расскажет вам новые хитрости и нюансы, которых вы раньше не знали.</li>
										<li><span class="price">2</span> часть: Тренер покажет на собственном примере как это работает.</li>
										<li><span class="price">3</span> часть: Поможет вам повторить для закрепления знаний на практике.</li>
										<li><span class="price">4</span> часть: Во время занятия вы можете задавать любые вопросы которые вам интересны. Это поможет вам узнать еще больше.</li>
									</ul>
								</div>
								<div class="col-md-12"><p>Занятия проходят по <span class="price">2</span> часа в день, <span class="price">6</span> дней в неделю. Курс обучение продлится <span class="price">12</span> часов.</p></div>
								<div class="col-md-12"><p>Наши тренеры находятся на про сцене уже долгие годы и знают нюансы игры, которых нет в общем доступе. <br>Они могут рассказать о хитростях исполнения на разных ролях, о координации вашего коллектива, о про сцене и многом другом.<br>Во время турниров, тренер может брать перерыв в занятиях.<br>Мы не несем ответственности за действия игрока, если вы пишите напрямую тренеру, обходя нас стороной.</p></div>
								</div>
							</div>

							<span class="remark">*Задать вопросы, узнать стоимость, а так же договориться о тренировках можно, обратившись к администратору.<br>*Мы не несем ответственности за действия игрока, если вы пишите напрямую бустеру, обходя нас стороной.</span>

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
				</div>
			</div>
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