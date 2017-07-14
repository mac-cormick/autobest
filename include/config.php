<?php

$config = array(
	'title' => '',

	'db' => array(
		'server' => 'localhost',
		'username' => 'root',
		'password' => '',
		'name' => 'autobest'
	)
);

require "db_connect.php";

function email_valid($user_mail) {
	if( !filter_var( $user_mail, FILTER_VALIDATE_EMAIL))
		exit('<span class="warn">Некорректный E-mail!</span>');
}

function password_valid($user_pass) {
	if ( !preg_match('/^[A-z0-9]{5,30}$/', $user_pass) )
		exit('<span class="warn">Пароль может содержать 5 - 30 латинских букв и цифр!</span>');
	$_POST['user_password'] = md5($_POST['user_password']);
}

function random_str( $num = 30 ) {
	return substr(str_shuffle('0123456789abcdefghijklmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $num);
}

?>
