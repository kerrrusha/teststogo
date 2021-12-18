<?php 
	require_once "../libs/rb.php";		//подключение библиотеки RedBean PHP
	require "../blocks/db.php";
	
	$data = $_POST;
	$login = $data['login'];
	if(isset($data['do_login']))
  	{
	    //авторизуем тут
	    $errors = array();
	    $user = R::findOne('user', 'login = ?', array($data['login']));

	    echo "<script>console.log('Check started');</script>";

	    //если логин существует
	    if($user)
	    {
	    	//если пароли совпадают
	    	if(password_verify($data['password'], $user->password))
	    	{
		    	//активируем сессию
		    	// $_SESSION['logged_user'] = $user->username;
		    	// $_SESSION['logged_user_id'] = $user->id;    	

	    		//ставим кукис на месяц
	    		$time = 60 * 60 * 24 * 30;
	            setcookie('logged_user', $user->username, time() + $time, "/");
	            setcookie('logged_user_id', $user->id, time() + $time, "/");
	            
	    		header('Location: /index.php?lgn='.$login.'&e=1&p=1#tab-3');

				//echo '<script type="text/JavaScript">window.location.reload();</script>'; 
				//echo '<section style="color: green; display:flex; align-items: center;"><article> Ви успішно авторизовані </article></section><hr>';
			}
		    else
		    {
		    	//Пароль невірний
		    	header('Location: /index.php?lgn='.$login.'&e=1&p=0#tab-3');
		    }
	    }
	    else
	    {
			//Такого аккаунту не існує
			header('Location: /index.php?lgn='.$login.'&e=0&p=1#tab-3');
	    }
	}

    //header('Location: /index.php#tab-3');
?>