<?php 
	//unset($_SESSION['logged_user']);

	//убираем кукис поставленные на месяц
	$time = 60 * 60 * 24 * 30;
	setcookie('logged_user', $user->username, time() - $time, "/");
	setcookie('logged_user_id', $user->id, time() - $time, "/");

	header('Location: /');
?>