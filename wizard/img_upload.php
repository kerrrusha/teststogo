<?php 
	if($_FILES['file']['name'] != '')
	{
	    //id користувача
	    $uid = $_COOKIE['logged_user_id'];

	    $test = explode('.', $_FILES['file']['name']);
	    $extension = end($test);    
	    //$name = rand(100000,999999).'.'.$extension;
	    $name = array_shift($test).'.'.$extension;

	    $dir = "../images/tests/user_tests_logo/". $uid ."/";
	    $location = $dir.$name;
	    
	    //если нет папки с id пользователя, создаем
	    if (!file_exists($dir)) 	
	    	mkdir($dir, 0777, true);

	    // если файл уже существует
		if (file_exists($location)) 
		{
		  // echo "Такий файл вже існує. Завантажте інший або перейменуйте даний";
		  echo '<img id="img_preview" src="'.$location.'" class="rounded-circle" height="150" width="150">';
		  exit();
		}

	    move_uploaded_file($_FILES['file']['tmp_name'], $location);

	    echo '<img id="img_preview" src="'.$location.'" class="rounded-circle" height="150" width="150">';
	}
?>