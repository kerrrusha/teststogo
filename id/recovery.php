<?php 
  require_once "../libs/rb.php";   //подключение библиотеки RedBean PHP
  require "../blocks/db.php";

  $data = $_POST;

  $send = 0;         //удалось ли отправить письмо
  $refreshed = 0;    //отправляли ли уже первую форму форму
  $refreshed2 = 0;

  //echo "<script>console.log('PHP check started; send = $send; refreshed = $refreshed');</script>";    //отладка

  echo "<script>console.log('php started');</script>";
  if(isset($data['submit1']))
  {
      echo "<script>console.log('php is processing 1st form');</script>";

      $refreshed = 1;    //если не было совпадений в бд (второй if) и форму отправляли уже (первый if)

      $we = "teststogoteam@gmail.com";    //наша почта (отправитель)
      $login = !empty($data['login']) ? $data['login'] : '';

      //если в таблице с кодами уже есть запрос от этого пользователя
      if(R::findOne('key', 'login = ?', array($login)))
      {
        echo "<script>console.log('code-query database already have an entry with login = $login');</script>";
        echo "<script> window.addEventListener('load', function () {var msg = document.querySelector('#resultmsg'); msg.innerHTML='ПОВІДОМЛЕННЯ БУЛО НАДІСЛАНО РАНІШЕ';})</script>";
        $send = 1;
      }
      //если в бд нет совпадений на введенный логин
      else if(R::count('user', "login = ?", array($data['login'])) == 0)   
      {
          echo "<script>console.log('login not exists');</script>";
      }
      else
      {
          //шестизначный секретный код подтверждения
          $secret = rand(100000,999999);

          // *** To Email ***
          $to = $login;
          // *** Subject Email ***
          $subject = 'Відновлення доступу [Tests To GO]';
          // *** Content Email ***
          $content = 
"<html> <head><link href='https://fonts.googleapis.com/css2?family=Roboto&display=swap' rel='stylesheet'></head> <body style='color: black;'>Ви підтверджуєте вхід.<br>Будь ласка, введіть наступний код:\t <h1>".$secret."</h1>
<br>
Будь ласка, зверніть увагу:<br>
Після перевірки ви зможете змінити свій пароль та отримати повний доступ до аккаунту.<br>
Якщо ви не подавали заявку на отримання коду підтвердження,
будь ласка, увійдіть у свій обліковий запис і змініть пароль, щоб забезпечити безпеку свого облікового запису.<br>
Щоб захистити свій обліковий запис, не надавайте іншим доступ до вашої електронної пошти.</body></html>";
          //*** Head Email ***
          $headers = "From: " . strip_tags($we) . "\r\n";
          $headers .= "Reply-To: ". strip_tags($to) . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
          //*** Show the result... ***
          if (mail($to, $subject, $content, $headers))
          {
              echo "<script>console.log('Email was sent');</script>";
              $send = 1;     //письмо успешно отправлено
          } 
          else 
          {
              echo "<script>console.log('Email was NOT sent');</script>";
          }

          $secret = password_hash($secret, PASSWORD_DEFAULT);
          
          $key = R::dispense('key');

          $key->login = $login;
          $key->secret = $secret;
          $key->sendtime = date("d-m-Y H:i:s");

          R::store($key);
      }
  }
  if(isset($data['submit2']))    //если отправили вторую форму
  {
    echo "<script>console.log('php is processing 2nd form');</script>";

    //header('Location: /');
    $refreshed = 1;
    $refreshed2 = 1;
    $send = 1;

    $login = !empty($data['login']) ? $data['login'] : '';
    $answer = !empty($data['answer']) ? $data['answer'] : '';

    /*echo "<script>console.log('login - $login');</script>";
    echo "<script>console.log('answer - $answer');</script>";*/

    //проверить секрет для введенного логина
    $key = R::findOne('key', 'login = ?', array($login));
    if($key)
    {
        //если пароли совпадают
        if(password_verify($answer, $key->secret))
        {
          echo "<script>console.log('key SUCCESS');</script>";
          R::trash($key);
          
          $user = R::findOne('user', 'login = ?', array($login));
          
          //если логин существует
          if($user)
          {
            //авторизуем
            $time = 60 * 60 * 24 * 30;
            setcookie('logged_user', $user->username, time() + $time, "/");
            setcookie('logged_user_id', $user->id, time() + $time, "/");
            
            header('Location: /index.php#tab-3');
          }
          else
          {
            echo "<script>console.log('login not exists');</script>";
          }
        }
        else
        {
          echo "<script>console.log('key FAIL');</script>";
        }
    }
    else
    {
        echo "<script>console.log('code-query database have no entry with login = $login');</script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  
   <!-- Bootstrap CSS (jsDelivr CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"> </script>
  <link rel = "stylesheet" href = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script src="/js/main.js"></script>
  <title>Reset password</title>
  <link rel="icon" type="image/png" href="https://findicons.com/files/icons/2770/ios_7_icons/512/brain.png" sizes="512x512">

</head>
<body>
   <?php require("../blocks/header.php"); ?>


    <div class="container col-lg-5 mx-auto">
      <div class="p-5 bg-light rounded text-center">
        <?php if($send == 0) : ?>
        
          <p class="lead m-0">ВІДНОВЛЕННЯ ПАРОЛЮ</p>
          <h2 class="mb-5">Вкажіть e-mail аккаунта</h2>
          <form action="../id/recovery.php" method="post" class="needs-validation" novalidate>
            <div class="mb-5">
              <input type="email" class="form-control validate-me" id="email" name="login" placeholder="E-mail" value="<?php echo $login = !empty($_POST['login']) ? $_POST['login'] : '';?>" required>
              <span class="text-muted">Ми надішлемо вам лист з подальшими інструкціями</span>
              <div class="invalid-feedback">
                Такого користувача не існує.
              </div>
            </div>    
            <div class="mb-3 text-center">
              <button class="btn btn-primary py-2 w-50" name="submit1" type="submit">Надіслати</button>
            </div>    
          </form>
        
        <?php else : ?>

          <p class="lead mb-4" id="resultmsg">НАДІСЛАНО УСПІШНО</p>
          <h2>Перевірте вказану поштову скриньку:</h2> 
          <p class="lead m-2 mb-5"><?php echo $login = !empty($_POST['login']) ? $_POST['login'] : '';?></p>
          <h2>Шестизначний код:</h2>
          <form action="../id/recovery.php" method="post">
              <input type="email" style="display: none;" name="login" value="<?php echo $login = !empty($_POST['login']) ? $_POST['login'] : '';?>">
              <input type="text" placeholder="ХХХХХХ" id="answer" name="answer" maxlength="6" style="width:110px" size="6" class="form-control mx-auto mt-3 text-center">
              <div class="invalid-feedback">
                Код невірний
              </div>
              <button onclick="checkAnswer()" class="btn btn-primary py-2 w-50 mt-3" name="submit2" type="submit">Підтвердити</button>
          </form>
          <a href="../index.php#tab-3">Назад</a>

        <?php endif; ?>
      </div>
    </div>

    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
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
                  
                  const invalidGroup = form.querySelectorAll(":invalid");
                  for (let j = 0; j < invalidGroup.length; j++) 
                  {
                      invalidGroup[j].classList.add('is-invalid');
                  }
                  }
              }, false);
          });
          }, false);
      })();

      //мгновенная проверка на соответствие почты с базой данных
      var email = document.querySelector('#email');
      //если письмо еще не отправлено и страничка уже обновлялась (очевидно правильную почту еще не ввели)
      if(! <?php echo $send ?> && <?php echo $refreshed ?>)  
      {
          email.classList.add('is-invalid');    //выводим ошибку
      }

      function checkAnswer()
      {
        var answer = document.querySelector('#answer');
        if(answer.value.length != 6)
        {
          event.preventDefault();
          event.stopPropagation();
          answer.classList.add('is-invalid');    
        }
      }
    </script>

<?php require "../blocks/footer.php"?>
</body>
</html>