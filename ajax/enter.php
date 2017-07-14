<?php
require "../include/config.php";
session_start();
?>

<?php
	if (!empty($_GET['value_log']))
	{
		$user_login = $_GET['value_log'];
		if ($user_login == '')
		{
			unset($user_login);
		}
	}
	if (!empty($_GET['value_pass']))
	{
		$user_password=$_GET['value_pass'];
		if ($user_password == '')
		{
			unset($user_password);
		}
	}
	if (empty($user_login) or empty($user_password))
	{
		echo ("<span class='warn'>Заполните все поля!</span>");
	} else
	{
		$user_login = stripslashes($user_login);
		$user_login = htmlspecialchars($user_login);
		$user_password = stripslashes($user_password);
		$user_password = htmlspecialchars($user_password);
		$user_login = trim($user_login);
		$user_password = trim($user_password);

		$result = mysqli_query($link, "SELECT * FROM users WHERE user_login='$user_login'");
		$row = mysqli_fetch_array($result);
		if (empty($row['user_password']))
		{
			echo ("<span class='warn'>Извините, введённый вами Логин или пароль неверный.</span>");
		} 
		else {
			if ($row['user_password']==$user_password) {
				if ( $row['user_status'] == 1 ) {
					$_SESSION['user_login']=$row['user_login'];
					$_SESSION['user_password']=$row['user_password'];
					$_SESSION['user_email']=$row['user_email']; 
					$_SESSION['user_id']=$row['user_id'];
					echo "<span class='succ'>Здравствуйте, $_SESSION[user_login] !</span>";
				} else {
					echo "<span class='warn'>Подтвердите регистрацию!<br><a href='/confirm.php'>Подтверждение регистрации</a></span>";
				}
			}
			else {
				echo ("<span class='warn'>Извините, введённый вами login или пароль неверный.</span>");
			}
		}
	}
?>