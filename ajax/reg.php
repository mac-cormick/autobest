<?php
require "../include/config.php";
?>

<?php

if (!empty($_GET['value_log'])) {
	$user_login = $_GET['value_log'];
	if ($user_login == '') {
		unset($user_login);
	}
}
if (!empty($_GET['value_email'])) {
	$user_email = $_GET['value_email'];
	if ($user_email == '') {
		unset($user_email);
	}
}
if (!empty($_GET['value_pass'])) {
	$user_password = $_GET['value_pass'];
	if ($user_password == '') {
		unset($user_password);
	}
}
password_valid($_GET['value_pass']);
email_valid($_GET['value_email']);
if (empty($user_login) or empty($user_password) or empty($user_email)) 
{
	echo ("<span class='warn'>Заполните асе поля!</span>");
} else
{
	$user_login = stripslashes($user_login);
	$user_login = htmlspecialchars($user_login);
	$user_email = stripslashes($user_email);
	$user_email = htmlspecialchars($user_email);
	$user_password = stripslashes($user_password);
	$user_password = htmlspecialchars($user_password);
	$user_login = trim($user_login);
	$user_email = trim($user_email);
	$user_password = trim($user_password);

	$result = mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `user_login`='$user_login'");
	$row = mysqli_fetch_array($result);
	if (!empty($row['user_id'])) {
		echo ("<span class='warn'>Логин занят!</span>");
	} else
	{
		$result = mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `user_email`='$user_email'");
		$row = mysqli_fetch_array($result);
		if (!empty($row['user_id'])) {
			echo ("<span class='warn'>Данный E-mail уже используется!</span>");
		} else {
			$user_code = random_str(5);
			mail($_POST['user_email'], 'Регистрация', "Код подтверждения регистрации: <b>$user_code</b>");
			$result2 = mysqli_query($link, "INSERT INTO `users` (user_login,user_email,user_password,user_code) VALUES ('$user_login','$user_email','$user_password','$user_code')");
			if ($result2 == 'TRUE')
			{
				echo "<span class='succ'>Вы зарегистрированы!</span><br>На указанный Вами E-mail отправлено письмо с кодом подтверждения информации.<br>Для завершения регистрации пройдите по ссылке";
				echo "<span class='succ'><a href='/confirm.php'>Подтверждение регистрации</a></span>";
			} else {
				echo "<span class='warn'>Ошибка! Вы не зарегистрированы!</span>";
			}
		}
	}
}
?>