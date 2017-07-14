<?php
require "include/header.php";
?>


<script>
	function load_data() {
		$('#answer').empty();
		$.get( '/ajax/enter.php', {value_log: $('#user_login').val(), value_pass: $('#user_password').val()}, function (data) {
			$('#answer').append(data);
		});
	}
</script>

<div id="content">

	<div class="container">
		<div class="row">

			<div class="col-md-9 col-sm-12 enter-form">

				<form action="" method="post" class="enter">
					<h2>Вход</h2>
					<input type="text" name="user_login" id="user_login" placeholder="Логин" /><br>
					<input type="password" name="user_password" id="user_password" placeholder="Пароль" /><br>
					<input onclick="load_data()"" type="button" name="do_submit" value="Войти">
					<a href="/reg.php">Регистрация</a>
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