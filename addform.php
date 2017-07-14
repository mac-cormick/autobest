<meta charset="utf-8" />

<?php
header("Location: /autobest");
require "include/header.php";
?>

<?php
if( isset($_POST['do_post']) )
{
	$errors = array();

	if ( $_POST['name'] == '' )
	{
		$errors[] = 'Введите имя!';
	}
	if ( $_POST['nickname'] == '' )
	{
		$errors[] = 'Введите логин!';
	}
	if ( $_POST['email'] == '' )
	{
		$errors[] = 'Введите Email!';
	}
	if ( $_POST['text'] == '' )
	{
		$errors[] = 'Введите текст коммкетария!';
	}

	if( empty($errors) )
	{
		mysqli_query($link, "INSERT INTO comments (name,nickname,email,text,pubdate,article_id) VALUES ('".$_POST['name']."', '".$_POST['nickname']."', '".$_POST['email']."', '".$_POST['text']."', NOW(), '".$_GET['id']."')");
		echo '<span style="color: green;font-weight: bold;margin-bottom: 10px; display: block;">Комментарий успешно добавлен!</span>';
		$_POST['name'] = "";
	} else
	{
		echo '<span style="color: red;font-weight: bold;margin-bottom: 10px; display: block;">' . $errors['0'] . '</span>';
	}
}
?>