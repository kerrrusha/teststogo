<?php 
  require_once "../libs/rb.php";   //подключение библиотеки RedBean PHP
  require "../blocks/db.php";

  $data = $_POST;
  if(isset($data['do_signup']))
  {
    //регистрируем тут

    $errors = array();
    if(trim($data['login']) == '')
    {
      $errors[] = 'Вкажіть логін';
    }

    if($data['password'] == '')
    {
      $errors[] = 'Вкажіть пароль';
    }

    if(trim($data['username']) == '')
    {
      $errors[] = "Вкажіть ім'я";
    }

    if($data['password2'] != $data['password'])
    {
      $errors[] = "Паролі не співпадають";
    }

    if(R::count('user', "login = ?", array($data['login'])) > 0)
    {
      $errors[] = "Користувач з таким e-mail вже існує";
    }

    if(R::count('user', "username = ?", array($data['username'])) > 0)
    {
      $errors[] = "Користувач з таким іменем вже існує";
    }

    if(empty($errors))
    {
      //все ок, регистрируем
      $user = R::dispense('user');

      $user->login = $data['login'];
      $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
      $user->creatingDate = date("d-m-Y H:i:s");
      $user->username = $data['username'];
      $user->birthday = $data['day'];
      $user->birthmonth = $data['month'];
      $user->birthyear = $data['year'];
      $user->sex = $data['sex'];
      $user->mailing = $data['mailing'];

      R::store($user);

      //ставим кукис на месяц
      $time = 60 * 60 * 24 * 30;
      setcookie('logged_user', $user->username, time() + $time, "/");
      setcookie('logged_user_id', $user->id, time() + $time, "/");

      header('Location: /index.php#tab-3');
    }
    else
    {
      echo '<section style="color: red; display:flex; 
    align-items: center;"><article>'.array_shift($errors).'</article></section><hr>';
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
  <title>Sign Up</title>
  <link rel="icon" type="image/png" href="https://findicons.com/files/icons/2770/ios_7_icons/512/brain.png" sizes="512x512">
</head>
<body>
  <?php require("../blocks/header.php"); ?>

    <div class="container col-lg-5 mx-auto">
    <div class="p-5 bg-light rounded">
      <div class="text-center">
         <p class="lead m-0">РЕЄСТРАЦІЯ</p>
        <h2 class="mb-5">Створіть власний аккаунт</h2>
      </div>

      <form action="/id/signup.php" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
              <input type="email" class="form-control validate-me" id="email" value="<?php echo @$data['email']; ?>" placeholder="E-mail" name="login" required>
              <div class="invalid-feedback">
                Введіть коректну поштову скриньку.
              </div>
            </div>
            
            <div class="mb-3">
            <input type="password" class="form-control validate-me" id="password" name="password" placeholder="Пароль" value="" required>
              <div class="invalid-feedback">
                Ваш пароль занадто простий.
              </div>
            </div>
            <div class="mb-3">
            <input type="password" class="form-control validate-me" id="password2" name="password2" placeholder="Введіть пароль ще раз" value="" required>
              <div class="invalid-feedback" id="pass_check">
                Паролі не співпадають.
              </div>
            </div>
                        
            <div class="mb-5">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control validate-me" id="username" name="username" placeholder="Ваше ім'я" value="<?php echo @$data['username']; ?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Будь-ласка, вкажіть ім'я.
                </div>
              </div>
              <span class="text-muted">З'являтиметься на сайті та у вашому профілі</span>
            </div>

            <div class="row">
              <label for="birthdate" class="text-center mb-1">Дата народження</label>
              <div class="col-md-4 mb-3">
                <select class="form-select" aria-label="Default select example" id="day" name="day" value="<?php echo @$data['day']; ?>">
                  <option value="" hidden>День</option>
                  <?php 
                    $from = 1;
                    $to = 31;

                    for ($i=$from; $i <= $to ; $i++) 
                    { 
                      echo "<option value='$i'>$i</option>";
                    }
                  ?>
                </select>
                <div class="invalid-feedback">
                  Please select a valid day.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <select class="form-select" aria-label="Default select example" id="month" name="month" value="<?php echo @$data['month']; ?>">
                  <option value="" hidden>Місяць</option>
                  <option value="1">Січень</option>
                  <option value="2">Лютий</option>
                  <option value="3">Березень</option>
                  <option value="4">Квітень</option>
                  <option value="5">Травень</option>
                  <option value="6">Червень</option>
                  <option value="7">Липень</option>
                  <option value="8">Серпень</option>
                  <option value="9">Вересень</option>
                  <option value="10">Жовтень</option>
                  <option value="11">Листопад</option>
                  <option value="12">Грудень</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid month.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <select class="form-select" aria-label="Default select example" id="year" name="year" value="<?php echo @$data['year']; ?>">
                  <option value="" hidden>Рік</option>
                  <?php 
                    $from = date("Y");
                    $to = $from - 100;

                    for ($i=$from; $i >= $to ; $i--) 
                    { 
                      echo "<option value='$i'>$i</option>";
                    }
                  ?>
                </select>
                <div class="invalid-feedback">
                  Please select a valid year.
                </div>
              </div>
            </div>

            <div class="mb-5">
              <div class="input-group">
                <select class="form-select" aria-label="Default select example" id="sex" name="sex" value="<?php echo $data['sex']; ?>">
                  <option value="" hidden>Оберіть стать...</option>
                  <option value="1">Чоловіча</option>
                  <option value="2">Жіноча</option>
                </select>
              </div>
            </div>

            <label class="d-inline-block mb-2">
              <input class="form-check-input me-2" type="checkbox" name="mailing" value="1" checked>
              <small class="text-muted">Отримувати корисні сповіщення на e-mail</small>
            </label>
            <button class="btn btn-primary py-2 w-100" type="submit" id="do_signup" name="do_signup">Продовжити</button>
          </form>
          <div class="container text-center mt-3">
            <span>Вже зареєстровані? <a href="/index.php#tab-3">Увійти</a></span>
          </div>
        </div>
    </div>

<?php require "../blocks/footer.php"?>

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
                 
                 //проверка на совпадение паролей
                  var pass1 = document.querySelector('#password'), 
                      pass2 = document.querySelector('#password2');

                  if(pass1.value != pass2.value)
                  {
                    pass2.classList.add('is-invalid');
                  }
                  else
                  {
                    pass2.classList.remove('is-invalid');
                  }
              }, false);
          });
          }, false);
      })();
    </script>
  </body>
  </html>