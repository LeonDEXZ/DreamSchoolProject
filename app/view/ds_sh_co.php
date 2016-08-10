<section class="row info-boxs">
	<div class="col-md-12 info-box">
		<div class="info-box-title">Школа комментаторов</div>
		<div class="blog-content" style="height: 100%;">
			<div class="subinfo_box" align="center">ВНИМАНИЕ, СЕЙЧАС ДЕЙСТВУЕТ СКИДКА НА КУРС ОБУЧЕНИЯ <span class="price">50 <i class="fa fa-percent" aria-hidden="true"></i></span></div>
			<div class="subinfo_clear_box">Друзья, у нас идёт постоянный набор на курсы комментаторов.<br>У каждого начинающего стримера появился шанс научиться делать это профессионально и добиться успеха.<br>Обучение проводит <a href="">Вадим "NyawHARD" Лебедев</a>.<br>Курс состоит из 3-х занятий по полтора часа, включая теорию и практику работы на стриме.<br>Вадим поделится опытом, расскажет, как правильно преподносить свои мысли, что стоит говорить на стриме, как правильно работать с голосом, тембром, интонацией, о чем говорить со зрителем, как заинтересовать публику и многое другое. Так же будет давать задания на дом. Курс включает в себя практику комментирования на посещаемых стримах. Лучших учеников мы будем рекомендовать в аналитические и комментаторские студии.<br>Обучение проводится группами по 4 человека. Так же возможно и индивидуальное обучение.<br>Стоимость курса со скидкой - <span class="price">2500 <i class="fa fa-rub" aria-hidden="true"></i></span>.<br>Не упустите шанс научиться комментировать и заявить о себе!</div>
			<span class="subinfo_remark">*Мы не несем ответственности за действия тренера, если вы пишите ему напрямую, обходя нас стороной.<br>*Задать вопросы, узнать стоимость, а так же договориться о тренировках можно, обратившись к администратору.</span>
			<div style="display: -webkit-flex;display: -moz-flex;display: -ms-flex;display: -o-flex;display: flex;">
				<a class="acce-but popup-with-form" href="#test-form">Связаться с администратором</a>
			</div>
			<form id="test-form" class="popup-body mfp-hide">
				<div class="popup-title">Обратная связь</div>
				<fieldset style="border:0;">
					<input id="name" name="name" type="text" placeholder="Как к вам обращаться?" required="" class="text_box">
					<input id="email" name="email" type="email" placeholder="Куда ответить? (VK, E-Mail, Телефон)" required="" class="text_box">
					<textarea id="textarea" class="textarea_box" rows="12" placeholder="Ваше пожелание..."></textarea>
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