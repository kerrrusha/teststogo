<?php 
	if(isset($_POST['filename']))
	{
		//id користувача
	    $uid = $_COOKIE['logged_user_id'];
	    $name = $_POST['filename'];

	    $dir = "../images/tests/user_tests_logo/". $uid ."/";
	    $location = $dir.$name;

		if (unlink(htmlentities($location))) 
		{
			echo "success";
		}
	}
?>