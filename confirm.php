<?php
require "include/header.php";
?>

<script>
	function load_data() {
		$('#answer').empty();
		$.get( '/ajax/confirm.php', {value: $('#user_code').val()}, function (data) {
			$('#answer').append(data);
		});
	}
</script>

<div id="content">

	<div class="container">
		<div class="row">

			<div class="col-md-9 col-sm-12 enter-form">

				<form action="" id="confirm" method="post" class="enter">
					<h2>Подтверждение регистрации</h2>
					<h3>Для подтверждения регистрации введите код, высланный на указанный Вами E-mail</h3>
					<input type="text" id="user_code" name="user_code" placeholder="Код регистрации" /><br>
					<input onclick="load_data()" type="button" id="but" name="do_code" value="Регистрация">
				</form>

				<div id="answer"></div>

				

			</div>

			<?php
			include "include/sidebar.php";
			?>

		</div>
	</div>


</div>


<?php
include "include/footer.php";
?>


</body>
</html>