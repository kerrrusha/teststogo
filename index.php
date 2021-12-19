<?php
	require_once "libs/rb.php";   				//подключение библиотеки RedBean PHP
  	require "blocks/db.php"; 
?>

<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/chart.css">

    <title>Тests To GO</title>
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

	<script src="js/main.js"></script>
	<!--HighCharts-->
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>
</head>
<body>
	<div id='header' class='text-center'>
		<a href="index.php">
			<img src="images/logo.png" class='img w-50' style="max-width: 500px; min-width: 300px;">
		</a>
	</div>

	<div id="tabs" class="m-0">
		<!-- Кнопки -->
		<div class="tabs-nav row">
			<div class="col-md-3 p-0"><a href="#tab-1">Головна сторінка</a></div>
			<div class="col-md-3 p-0"><a href="#tab-2">Статистика</a></div>
			<div class="col-md-3 p-0"><a href="#tab-3">Мій аккаунт</a></div>
			<div class="col-md-3 p-0"><a href="#tab-4">Інформація</a></div>
		</div>
		
		<!-- Контент -->
	   	<div class="tabs-items">
			<div class="tabs-item" id="tab-1">
				<?php require "blocks/main.php"; ?>
			</div>
			<div class="tabs-item" id="tab-2">
				<?php require "blocks/stat.php"; ?>
			</div>
			<div class="tabs-item" id="tab-3">
				<?php require "blocks/profile.php"; ?>
			</div>	
			<div class="tabs-item" id="tab-4">
				<?php require "blocks/about.php"; ?>
			</div>		
	    </div> 
	</div>
	<?php require "blocks/footer.php"?>


	<script>
      //  disabling form submissions if there are invalid fields
      (function() 
      {
        'use strict';

         window.addEventListener('load', function () 
         {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          const forms = document.getElementsByClassName('needs-validation');
          Array.prototype.filter.call(forms, function (form) 
          {
              form.addEventListener('submit', function (event) 
              {              
                  if (form.checkValidity() === false) 
                  {
                      event.preventDefault();
                      event.stopPropagation();
                  }
                  	
                  const invalidGroup = form.querySelectorAll(":invalid");
                  for (let j = 0; j < invalidGroup.length; j++) 
                  {
                      invalidGroup[j].classList.add('is-invalid');
                  }

                  //снятие флажков с корректно введенных форм
                  const totalGroup = document.querySelectorAll('.validate-me');
                  console.log(totalGroup.length);
                  for(let i = 0; i < totalGroup.length; i++)
                  {
                      var isCorrect = 1;
                      for (let j = 0; j < invalidGroup.length; j++) 
                      {
                        if(totalGroup[i] == invalidGroup[j])
                        {
                          isCorrect = 0;
                        }
                      }
                      if (isCorrect == 1)
                      {
                        totalGroup[i].classList.remove('is-invalid');
                      }
                  }                  
              }, false);
          });
          }, false);
      })();


					//сообщения о неверно веденном пароле или несуществующем пользователе
	    			  var login = document.querySelector('#login');
	                  var logmsg = document.querySelector('#logmsg');
	                  var pass = document.querySelector('#password');
	                  var passmsg = document.querySelector('#passmsg');
	                  //результаты проверки пароля
	                  var e = <?php echo $e = isset($_GET['e']) ? $_GET['e'] : 1; ?>;
	                  var p = <?php echo $p = isset($_GET['p']) ? $_GET['p'] : 1; ?>;		
	                  
	                  console.log('e = ' + e.toString());
	                  console.log('p = ' + p.toString());
	                  
	                  if(!e && p)
	                  {
	                  	logmsg.innerHTML = 'Такого користувача не існує';
	                  	login.classList.add('is-invalid');

	                  	pass.classList.remove('is-invalid');
	                  }
	                  else if(e && !p)
	                  {
	                  	passmsg.innerHTML = 'Невірний пароль';
	                  	pass.classList.add('is-invalid');

	                  	login.classList.remove('is-invalid');
	                  }
	                  else if(!e && !p)
	                  {
	                  	passmsg.innerHTML = 'Невірний пароль';
	                  	pass.classList.add('is-invalid');

	                  	logmsg.innerHTML = 'Такого користувача не існує';
	                  	login.classList.add('is-invalid');
	                  }
    </script>
</body>
</html>