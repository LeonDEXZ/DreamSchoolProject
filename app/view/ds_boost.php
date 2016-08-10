<section class="row">
	<div class="col-md-12">
		<div class="style_box">
			<div class="row">
				<div class="col-md-12">
					<div class="head text-center">Boost RMM DOTA 2</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="body">
						<div class="boost">
							<div class="box">Если вы хотите поднять рейтинг, то мы вам поможем.</div>

							<select name="boost_type[]">
								<option value="solo">Одиночный рейтинг</option>
								<option value="party">Группой рейтинг</option>
							</select>
							<input type="text" class="text_box" placeholder="Ваш текущий RMM">
							<input type="text" class="text_box" placeholder="Какой RMM вы хотите?">

							<div class="row">
								<div class="col-md-12">
									<div class="line">
										<div class="row">
											<div class="col-md-3"><span class="first">Поднятие:</span></div>
											<div class="col-md-6"></div>
											<div class="col-md-3">
												<div class="text-right">
													<span class="second" id="need_rmm">1111 <span>RMM</span></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="line">
										<div class="row">
											<div class="col-md-3"><span class="first">Скидка:</span></div>
											<div class="col-md-6"></div>
											<div class="col-md-3">
												<div class="text-right">
													<span class="second" id="discount">15 <i class="fa fa-percent" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="line">
										<div class="row">
											<div class="col-md-3"><span class="first">Итог:</span></div>
											<div class="col-md-6"></div>
											<div class="col-md-3">
												<div class="text-right">
													<span class="second" id="result">1111 <i class="fa fa-rub" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<span class="remark">*Точная стоимость с учётом скидок.<br>*Мы не несем ответственности за действия игрока, если вы пишите напрямую бустеру, обходя нас стороной.<br>*По заказу поднятия рейтинга обратитесь к администратору.</span>

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
	<div class="col-md-12">
		<div class="style_box">
			<div class="row">
				<div class="col-md-12">
					<div class="head text-center">Резюме наших бустеров</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="body">
						<div class="row">
							<?php
							foreach ($this->DATA['booster'] as $value) {
								$url = DEX_SITE_PATH.'/trainer_profile/'.$value['id'];

								$full_name = $value['first_name'].' '.$value['nickname'].' '.$value['last_name'].' ('.$value['rmm'].' RMM)';

								echo '<div class="col-md-12">';
									echo '<div class="box">';
										echo '<a class="move" href="#prof-'.$value['id'].'" onClick="move_profile(event, '.$value['id'].', \''.$full_name.'\');" >'.$full_name.'</a>';
									echo '</div>';
								echo '</div>';
							}
							?>
						</div>									
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
function move_profile(event, id, name)
{
	event.preventDefault();

	var page = {mod: 'trainer_profile', id: id};

	window.history.pushState({load_state: true, pageObj: page}, name, SitePath+"/profile/"+id);
	$('title').html(name);

	ajax_load(page);
}

$(document).ready(function() {
	$('select').styler();

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