<?php 
  require_once "../libs/rb.php";           //подключение библиотеки RedBean PHP
  require_once "../blocks/db.php"; 
  require_once "../tests/class_description.php";

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
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,900&display=swap" rel="stylesheet">

	<!-- Bootstrap CSS (jsDelivr CDN) -->
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  	<!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"> </script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<title>Новий тест</title>

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php require "icons.html"; ?>
<main>
  <!-- панель навигации для полной версии -->
<div id='full-nav' class="d-flex flex-column flex-shrink-0 p-3 bg-light navigation" style="width: 280px;">
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
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#view-stacked"></use></svg>
          Заповнення
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link link-dark" id="finish-tab" data-bs-toggle="tab" data-bs-target="#finish" type="button" role="tab" aria-controls="finish" aria-selected="false">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#check2-circle"></use></svg>
          Підсумок
        </a>
      </li>
      <li class="nav-item mt-auto">
        <a class="nav-link link-dark" id="site-link" href="../index.php">
          <hr>
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#arrow-90deg-left"></use></svg>
          На головну
        </a>
      </li>
    </ul>
    <hr>
    <div class="d-flex flex-row">
      <img src="<?php echo R::getRow('select avatar_url from user where id = ?', [$_COOKIE['logged_user_id']])['avatar_url']; ?>" class="rounded-circle" width=30 height=30>
      <div class="dropdown mx-3 d-flex align-middle">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
          <strong>@<?php echo R::getRow('select username from user where id = ?', [$_COOKIE['logged_user_id']])['username']; ?></strong>
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
  </div>

  <!-- панель навигации для мобильной версии -->
  <div id='mobile-nav' class="d-flex flex-column flex-shrink-0 bg-light navigation" style="width: 4.5rem;">
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
          <svg class="bi" width="24" height="24"><use xlink:href="#view-stacked"></use></svg>
        </a>
      </li>
      <li>
        <a class="nav-link link-dark py-3 border-bottom" id="finish-tab" data-bs-toggle="tab" data-bs-target="#finish" type="button" role="tab" aria-controls="finish" aria-selected="false">
          <svg class="bi" width="24" height="24"><use xlink:href="#check2-circle"></use></svg>
        </a>
      </li>
    </ul>
    <div class="dropdown border-top">
      <a href="" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="<?php echo R::getRow('select avatar_url from user where id = ?', [$_COOKIE['logged_user_id']])['avatar_url']; ?>" class="rounded-circle" width=24 height=24>
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

  	<div class="tab-content w-100" id="myTabContent" style="margin-left: 280px;">
	  	<div class="tab-pane fade show active" id="start" role="tabpanel" aria-labelledby="start-tab">
        <div class="row container wizard-step py-5">
          <div class="mx-auto my-auto">
            <div class="container-fluid pb-5 mb-3 mx-3">
              <h1 class="display-5 fw-bold">Майстер створення тестів</h1>
              <p class="col-md-8 fs-4 mb-5">Вітаємо у нашому застосунку для створення та налаштування ваших тестів!</p>
              <p class="col-md-8 fs-5">Щоб розпочати - оберіть бажаний тип тестування:</p>
              <table class="table text-center" style="table-layout: fixed;">
                <tbody>
                  <tr>
                    <td>
                      <button type="button" onclick="$('#info-tab').tab('show')" class="btn btn-outline-dark h-100 p-3 text-start">
                        Технічний
                      </button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-outline-dark h-100 p-3 text-start disabled">
                        Абстрактний
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h2>Технічний</h2>
                      <div class="text-start">
                        <p><br>Тест формату "правильно-неправильно" з гнучкими налаштуваннями.</br> </br>
                      Існує два режими:</br>
                      <strong>звичайний</strong> - за проходження можна отримати Рейтингові бали; їх кількість визначається адміністрацією сайту</br>
                      <strong>екзаменаційний</strong> - робота на оцінку; автор може переглядати проходження його тесту іншими учасниками; ви особисто визначаєте бали (оцінку) для кожного питання.</p>
                      </div>
                    </td>
                    <td>
                      <h2>Абстрактний</h2>
                      <div class="text-start">
                        <p><br>Тест формату "дізнайся свій психотип" або "хто ти із серіалу" з унікальними методами оцінювання.<br><br>
                      У питань немає правильної відповіді, а результати можна дізнатися лише після виконання тесту.<br><br>
                      Автор не бачитиме проходження його тестів, за виконання можна отримати лише Рейтингові бали.</br>
                      Для кожного тесту створюється персональний метод оцінювання.
                      </p>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>  
      </div>
	  	<div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
        <div class="row container wizard-step py-5">
          <div class="mx-auto my-auto">
            <h1 class="display-5 fw-bold mb-5">Основні дані тесту</h1>
            <div class="mb-3">
              <label for="name">Назва</label>
              <input type="text" class="form-control validate-me" id="name" name="name" placeholder="" value="" required>
            </div>
            <div class="mb-3">
              <label for="description">Опис</label>
              <textarea class="form-control" id="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="category">Категорія</label>
              <select class="form-select" aria-label="Default select example" id="category" name="category" value="">
                  <?php 
                    $test_categories = R::getAll("select * from test_category");

                    for($i = 0; $i < sizeof($test_categories); $i++)
                    {
                      echo '<option value="'.$test_categories[$i]['id'].'">'.mb_convert_case($test_categories[$i]['denominative'], MB_CASE_TITLE, "UTF-8").'</option>';
                    }
                  ?>
              </select>
            </div>
            <div class="mb-3">
              <span>Зображення (<strong>jpg/png/jpeg</strong> формату)</label></span><br>
              <div class="p-0 m-0">
                  <!-- загружаем изображение на сайт -->
                  <input type="file" class="form-control" name="fileToUpload" id="fileToUpload"/>
                  <div id="msg"></div>
                  <div id="img_preview_div" class="my-2">
                    <img id='img_preview' src="../images/png/test_icon_default.png" class="rounded-circle" height="150" width="150">
                  </div>
                  <button type="button" onclick="reset_logo()" id="delete_logo" class="btn btn-outline-dark" disabled>Видалити</button>
                  <!-- <button type="button" onclick="upload_logo()" class="btn btn-outline-dark">Встановити</button> -->
              </div>                
            </div>
            <hr class="mt-4">
            <div class="d-flex flex-row justify-content-between">
              <button type="button" onclick="go_back(2)" class="btn btn-outline-secondary btn-lg" style="width:150px;">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  <svg class="bi" width="36" height="20"><use xlink:href="#arrow-left"></use></svg>
                  Назад
                </div>
              </button>
              <button type="button" onclick="go_forward(2)" class="btn btn-outline-primary btn-lg" style="width:150px;">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  Далі
                  <svg class="bi" width="36" height="20"><use xlink:href="#arrow-right"></use></svg>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
	  	<div class="tab-pane fade" id="setup" role="tabpanel" aria-labelledby="setup-tab">
        <div class="row container wizard-step py-5">
          <div class="mx-auto my-auto">
            <h1 class="display-5 fw-bold">Налаштування</h1>
            <p class="col-md-8 fs-5">Оберіть режим, встановіть параметри та за потреби додайте обмеження до тесту, щоб зробити оцінювання максимально об'єктивним</p>
            <table class="table mt-5">
              <tbody>
                <tr>
                  <td>Правильні відповіді доступні одразу</td>
                  <td>
                    <div class="form-check form-switch d-flex align-items-center">
                      <input class="form-check-input p-0" type="checkbox" role="switch" id="show_answers" checked>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Перемішувати питання</td>
                  <td>
                    <div class="form-check form-switch d-flex align-items-center">
                      <input class="form-check-input p-0" type="checkbox" role="switch" id="tickets_shuffle">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Закрити доступ неавторизованим користувачам</td>
                  <td>
                    <div class="form-check form-switch d-flex align-items-center">
                      <input class="form-check-input p-0" type="checkbox" role="switch" id="for_authorised_users_only">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Тест на оцінку <small>(в цьому режимі Рейтингові бали недоступні)</small></td>
                  <td>
                    <div class="form-check form-switch d-flex align-items-center">
                      <input class="form-check-input p-0" type="checkbox" role="switch" id="testing_for_exam_points">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Встановити обмеження за часом</td>
                  <td>
                    <div class="form-check form-switch d-flex align-items-center">
                      <input class="form-check-input p-0" type="checkbox" role="switch" id="time_constraint_is_active">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div id="time_constraint_in_seconds_div"></div>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
              <div>
                В режимі тестування на оцінку та за обраної опції "Закрити доступ неавторизованим користувачам" автору тесту стають доступні персоналізовані результати та оцінки <small>(це може бути корисним для викладачів)</small>
              </div>
            </div>
            <hr class="mt-4">
            <div class="d-flex flex-row justify-content-between">
              <button type="button" onclick="go_back(3)" class="btn btn-outline-secondary btn-lg" style="width:150px;">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  <svg class="bi" width="36" height="20"><use xlink:href="#arrow-left"></use></svg>
                  Назад
                </div>
              </button>
              <button type="button" onclick="go_forward(3)" class="btn btn-outline-primary btn-lg" style="width:150px;">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  Далі
                  <svg class="bi" width="36" height="20"><use xlink:href="#arrow-right"></use></svg>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
	  	<div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="create-tab">
        <div class="row container wizard-step py-5">
          <div class="mx-auto my-auto" id="question_father">
            <?php 
              $ticket_types = R::getAll("select * from ticket_type");
            ?>
            <!-- для будущего использования -->
            <select class="form-select" id="ticket_types" name="ticket_type1" style="display: none;">
            <?php 
            for($i = 0; $i < sizeof($ticket_types); $i++)
            {
              echo '<option value="'.$ticket_types[$i]['id'].'">'.mb_convert_case($ticket_types[$i]['name'], MB_CASE_TITLE, "UTF-8").'</option>';
            }
            ?>
            </select>
            <h1 class="display-5 fw-bold">Питання та варіанти відповідей</h1>
            <p class="col-md-8 fs-5 mb-5">Створіть бажану кількість питань, додайте відповіді до них. Кожне питання налаштовується окремо (одиничний/множинний вибір). Не забудьте позначити правильну відповідь до кожного питання</p>
            <div id="ticketbox">
              <div class="card py-2 px-5 mb-2 border-dark">
                <div style="position: absolute; right: 10px; display: none;">
                  <button type="button" class="btn-close" aria-label="Close" onclick="remove_question(1)"></button>
                </div>
                <div class="row mb-3">
                  <div class="col-9">
                    <label for="question1">Питання #1</label>
                    <textarea class="form-control" id="question1" rows="2"></textarea>
                  </div>
                  <div class="col-3">
                    <label for="ticket_type1">Тип</label>
                    <select class="form-select" id="ticket_type1" name="ticket_type1" onchange="type_change(1)">
                        <?php 
                          for($i = 0; $i < sizeof($ticket_types); $i++)
                          {
                            echo '<option value="'.$ticket_types[$i]['id'].'">'.mb_convert_case($ticket_types[$i]['name'], MB_CASE_TITLE, "UTF-8").'</option>';
                          }
                        ?>
                    </select>
                  </div>
                </div>
                <hr>
                <div id='answerbox_ticket1'>
                  <div class="mb-3">
                    <div class="d-flex flex-row justify-content-between">
                      <div>
                        <input type="radio" id="ticket1_answer1_iscorrect"
                     name="ticket1" value="1">
                        <label for="ticket1_answer1_iscorrect">Відповідь #1</label>
                      </div>
                      <button type="button" class="btn-close" aria-label="Close" style="display: none;" onclick="remove_answer(1, 1)"></button>
                    </div>
                    <input type="text" class="form-control validate-me" id="ticket1_answer1" name="ticket1_answer1" placeholder="" value="" required>
                  </div>
                  <div class="mb-3">
                    <div class="d-flex flex-row justify-content-between">
                      <div>
                        <input type="radio" id="ticket1_answer2_iscorrect"
                         name="ticket1" value="1">
                        <label for="ticket1_answer2_iscorrect">Відповідь #2</label>
                      </div>
                      <button type="button" class="btn-close" aria-label="Close" style="display: none;" onclick="remove_answer(1, 2)"></button>
                    </div>
                    <input type="text" class="form-control validate-me" id="ticket1_answer2" name="ticket1_answer2" placeholder="" value="" required>
                  </div>
                </div>
                <button class="btn btn-outline-secondary w-100 p-2 mb-3" onclick="new_answer(1)">
                  <div class="mx-auto">
                    <svg class="bi flex-shrink-0 me-2" width="36" height="36" role="img" aria-label="Info:"><use xlink:href="#plus-circle"/></svg>
                    Додати відповідь
                  </div>
                </button>
              </div>
            </div>
            <button class="btn btn-outline-dark w-100 p-2" onclick="new_question()">
                <div class="mx-auto">
                  <svg class="bi flex-shrink-0 me-2" width="48" height="48" role="img" aria-label="Info:"><use xlink:href="#plus-circle-dotted"/></svg>
                  Нове питання
                </div>
              </button>
            <hr class="mt-4">
            <div class="d-flex flex-row justify-content-between">
              <button type="button" onclick="go_back(4)" class="btn btn-outline-secondary btn-lg" style="width:150px;">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  <svg class="bi" width="36" height="20"><use xlink:href="#arrow-left"></use></svg>
                  Назад
                </div>
              </button>
              <button type="button" onclick="go_forward(4)" class="btn btn-outline-primary btn-lg" style="width:150px;">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  Далі
                  <svg class="bi" width="36" height="20"><use xlink:href="#arrow-right"></use></svg>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
	  	<div class="tab-pane fade" id="finish" role="tabpanel" aria-labelledby="finish-tab">
        <div class="row container wizard-step py-5">
          <div class="mx-auto my-auto mt-0">
            <div id="error-box">
              <div class="alert alert-danger d-flex flex-column align-items-start" role="alert">
                <svg class="bi flex-shrink-0 me-2" style="position: absolute; left:20px;" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div class="mb-3 mx-auto">  
                  <strong>Здається, щось не так:</strong>
                </div>
                <ul class="m-0">
                  <li><a style="cursor:pointer;text-decoration: underline;" onclick="$('#info-tab').tab('show')">Не вказано <strong>назву</strong></a> <small>(мін. 3 символи)</small></li>
                  <li><a style="cursor:pointer;text-decoration: underline;" onclick="$('#create-tab').tab('show')">Не введено питання <strong>#1</strong></a> <small>(мін. 3 символи)</small></li>
                  <li><a style="cursor:pointer;text-decoration: underline;" onclick="$('#create-tab').tab('show')">Порожня відповідь <strong>#1</strong> до питання <strong>#1</strong></a></li>
                </ul>
              </div>
            </div>
            <div id="preview-box">
              <h1 class="display-5 fw-bold">Попередній перегляд</h1>
              <iframe class="w-100" src="test_preview.html" id="preview-frame" style="height:60vh;"></iframe>
            </div>
            <hr class="mt-4">
            <div class="d-flex flex-row justify-content-between">
              <button type="button" onclick="go_back(5)" class="btn btn-outline-secondary btn-lg" style="width:150px;">
                <div class="d-flex flex-row align-items-center justify-content-center">
                  <svg class="bi" width="36" height="20"><use xlink:href="#arrow-left"></use></svg>
                  Назад
                </div>
              </button>
              <button id="publicate" type="button" onclick="" class="btn btn-outline-primary btn-lg" style="width:250px;" disabled>
                <div class="d-flex flex-row align-items-center justify-content-center">
                  Опублікувати
                  <svg class="bi" width="36" height="20"><use xlink:href="#upload"></use></svg>
                </div>
              </button>
            </div>
          </div>
        </div>  
      </div>
	</div>
</main>
</body>
<script src="main.js"></script>
</html>