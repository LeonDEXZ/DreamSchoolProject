<div class="col-md-12">
	<div class="comments">
		<div class="row">
			<div class="col-md-12">
				<div class="title">Комментарии</div>
			</div>
			<div class="col-md-12">
				<div class="content">
					<div class="row" id="content">
						<?php
							$comments = $_GDB->Select('SELECT * FROM `comments` WHERE `place` = \'?\'', $place);
							if (empty($comments))
							{
								echo '<div id="no_comment" class="col-md-12 no_comment text-center">Комментариев нет</div>';
							}
							else {
								foreach ($comments as $c1)
								{
									$this->PrintComment($c1);
								}
							}
						?>
					</div>
				</div>
			</div>
			<?php if ($this->user_auth->IsLogin()): ?>
			<div class="col-md-12">
				<div class="feedback">
					<textarea id="comments_area" rows="6" class="textarea_box"></textarea>
					<a class="acce-but" id="send_comments" href="#send_comments">Отправить</a>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#send_comments').click(function(e){
		$.ajax({
			url: SitePath + "/index.php",
			type: 'GET',
			dataType: "html",
			data: {
				ajax: '',
				mod: 'add_commet',
				text: $('#comments_area').val(),
				place: '<?php echo $place; ?>'
			},
			success: function (data, textStatus) {
				$('#content').append($(data).hide().fadeIn(600));
				$('#comments_area').val('');
				$('.no_comment').hide();
			}
		});
		
		e.preventDefault();
	});
});
</script>