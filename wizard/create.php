<?php 
	//если сюда попал неавторизованный пользователь
	if(!isset($_COOKIE['logged_user_id']))
		header('Location: /index.php?#tab-4');

	$uid = $_COOKIE['logged_user_id'];

	if(isset($_POST['test_type']))
	{
		if($_POST['test_type'] == '0')
		{
			echo 1;
		}
		if($_POST['test_type'] == '1')
		{
			echo 2;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <link rel="icon" type="image/png" href="https://findicons.com/files/icons/2770/ios_7_icons/512/brain.png" sizes="512x512">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Bootstrap CSS (jsDelivr CDN) -->
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  	<!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"> </script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<title>Новий тест</title>

	<style type="text/css">
		main 
		{
	    display: flex;
	    flex-wrap: nowrap;
	    height: 100vh;
	    max-height: 100vh;
	    overflow-x: auto;
	    overflow-y: hidden;
	    flex-direction: row;
		}

    /* For Mobile */
    @media screen and (max-width: 540px) 
    {
      #full-nav {display: none!important;}
    }

    /* Full Version */
    @media screen and (min-width: 540px) 
    {
      #mobile-nav {display: none!important;}
    }     
	</style>
</head>
<body>
	<?php require "icons.html"; ?>
<main>
  <!-- панель навигации для полной версии -->
<div id='full-nav' class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <img src="../images/wizard_logo.png" style="height: 55px;">
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link link-dark active" id="start-tab" data-bs-toggle="tab" data-bs-target="#start" type="button" role="tab" aria-controls="start" aria-selected="true">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#puzzle"></use></svg>
          Тип тесту
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link link-dark" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#pencil"></use></svg>
          Загальні дані
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link link-dark" id="setup-tab" data-bs-toggle="tab" data-bs-target="#setup" type="button" role="tab" aria-controls="setup" aria-selected="false">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#gear-wide-connected"></use></svg>
          Налаштування
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link link-dark" id="create-tab" data-bs-toggle="tab" data-bs-target="#create" type="button" role="tab" aria-controls="create" aria-selected="false">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#check2-circle"></use></svg>
          Заповнення
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link link-dark" id="finish-tab" data-bs-toggle="tab" data-bs-target="#finish" type="button" role="tab" aria-controls="finish" aria-selected="false">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#view-stacked"></use></svg>
          Попередній перегляд
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown mx-3">
      <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <strong>@test</strong>
      </a>
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
        <li><a class="dropdown-item" href="">Мої проекти</a></li>
        <li><a class="dropdown-item" href="/index.php#tab-2">Рейтинг</a></li>
        <li><a class="dropdown-item" href="/index.php#tab-3">Профіль</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="/id/signout.php">Вихід</a></li>
      </ul>
    </div>
  </div>

  <!-- панель навигации для мобильной версии -->
  <div id='mobile-nav' class="d-flex flex-column flex-shrink-0 bg-light" style="width: 4.5rem;">
    <a href="" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
      <img src="../images/short_logo.png" style="width: 2.5rem;">
    </a>
    <hr class="mt-0">
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active py-3 border-bottom" id="start-tab" data-bs-toggle="tab" data-bs-target="#start" type="button" role="tab" aria-controls="start" aria-selected="true">
          <svg class="bi" width="24" height="24"><use xlink:href="#puzzle"></use></svg>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link py-3 border-bottom link-dark" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">
          <svg class="bi" width="24" height="24"><use xlink:href="#pencil"></use></svg>
        </a>
      </li>
      <li>
        <a class="nav-link link-dark py-3 border-bottom" id="setup-tab" data-bs-toggle="tab" data-bs-target="#setup" type="button" role="tab" aria-controls="setup" aria-selected="false">
          <svg class="bi" width="24" height="24"><use xlink:href="#gear-wide-connected"></use></svg>
        </a>
      </li>
      <li>
        <a class="nav-link link-dark py-3 border-bottom" id="create-tab" data-bs-toggle="tab" data-bs-target="#create" type="button" role="tab" aria-controls="create" aria-selected="false">
          <svg class="bi" width="24" height="24"><use xlink:href="#check2-circle"></use></svg>
        </a>
      </li>
      <li>
        <a class="nav-link link-dark py-3 border-bottom" id="finish-tab" data-bs-toggle="tab" data-bs-target="#finish" type="button" role="tab" aria-controls="finish" aria-selected="false">
          <svg class="bi" width="24" height="24"><use xlink:href="#view-stacked"></use></svg>
        </a>
      </li>
    </ul>
    <div class="dropdown border-top">
      <a href="" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
        <svg class="bi" width="24" height="24" role="img" aria-label="Customers"><use xlink:href="#people-circle"></use></svg>
      </a>
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
        <li><a class="dropdown-item" href="">Мої проекти</a></li>
        <li><a class="dropdown-item" href="/index.php#tab-2">Рейтинг</a></li>
        <li><a class="dropdown-item" href="/index.php#tab-3">Профіль</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="/id/signout.php">Вихід</a></li>
      </ul>
    </div>
  </div>

  	<div class="tab-content" id="myTabContent">
	  	<div class="tab-pane fade show active" id="start" role="tabpanel" aria-labelledby="start-tab">1</div>
	  	<div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">2</div>
	  	<div class="tab-pane fade" id="setup" role="tabpanel" aria-labelledby="setup-tab">3</div>
	  	<div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="create-tab">4</div>
	  	<div class="tab-pane fade" id="finish" role="tabpanel" aria-labelledby="finish-tab">5</div>
	</div>
</main>
</body>
</html>