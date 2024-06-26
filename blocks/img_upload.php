<?php
	require_once "../libs/rb.php";
    require_once "../blocks/db.php"; 

    $uid = isset($_COOKIE['logged_user_id']) ? $_COOKIE['logged_user_id'] : null;

    if(isset($_POST['test_logo']))
    {
    	$target_dir = "../images/tests/user_tests_logo/". $uid ."/";
    }
    else if(isset($_POST['profile_avatar'])) 
    	$target_dir = "../images/avatar/". $uid ."/";
    else
    	exit();


	//если нет папки с id пользователя, создаем
    if (!file_exists($target_dir)) 	
    {
    	mkdir($target_dir, 0777, true);
	}

	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) 
	{
	  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	  if($check !== false) 
	  {
	    echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	  } else 
	  {
	    echo "File is not an image.";
	    $uploadOk = 0;
	  }
	}

	// Check if file already exists
	if (file_exists($target_file)) 
	{
	  echo "Sorry, file already exists.";
	  $uploadOk = 0;
	}

	// макс. размер файла - 5 мб
	if ($_FILES["fileToUpload"]["size"] > 5 * 1024 * 1024) 
	{
	  echo "Sorry, your file is too large.";
	  $uploadOk = 0;
	}

	// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) 
    {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) 
	{
	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} 
	else 
	{
	  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	  {
	  	//обновляем путь к изображению в бд
	  	R::exec('update user set avatar_url=? where id = ?', [$target_file, $uid]);
	    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	  } 
	  else 
	  {
	    echo "Sorry, there was an error uploading your file.";
	  }
	}

	echo '</br></br>Вас буде перенаправлено назад через <strong>5</strong> секунд...';
	header( "Refresh:5; ../index.php#tab-3", true, 303);
?>