<?php
	require "../include/config.php";
?>

<?php

	$result = mysqli_query($link, "SELECT * FROM `users` WHERE `user_code`='$_GET[value]'");
	if ( mysqli_num_rows($result) > 0 ) {
		$row = mysqli_fetch_assoc($result);
		echo "<span class='succ'>Регистрация пройдена успешно!</span>";
		$result2 = mysqli_query($link, "UPDATE `users` SET `user_status`='1' WHERE `user_id`='$row[user_id]'");
	} else {
		echo "<span class='warn'>Неверный код!</span>";
	}
?>

