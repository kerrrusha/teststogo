<?php
    require_once "../libs/rb.php";           //подключение библиотеки RedBean PHP
    require_once "../blocks/db.php"; 
    require_once "class_description.php";

    //авторизован ли пользователь
    $authorised = isset($_COOKIE['logged_user_id']);

    $errors = array();

    //если указан id теста
    if(isset($_GET['id']))
    {
      $test_id = $_GET['id'];
      $test_sql = R::getRow("select * from test where id = $test_id");

      $test = new Test($test_sql);

      if($authorised)
      {
        $uid = $_COOKIE['logged_user_id'];
        $stat = new Stat($test, $uid); 
      }
    }
    else
    {
      $errors[] = "Некоректно обраний тест. Поверніться, будь-ласка, на <a href='../index.php' style='text-decoration:none;'>головну</a>";
    }

    $closed = 0;          //флажок для возможности закрывать доступ к тесту

    if($errors)
      echo "<center>" . array_shift($errors) . "</center>";

    //блок кода после нажатия кнопки "отправить тест"
    if(isset($_POST['send']))
    {
        if(isset($_COOKIE['logged_user_id']))
        {
          //var_dump($_POST);
          $uid = $_COOKIE['logged_user_id'];
          $current_time = date('Y-m-d H:i:s');

          $score = $stat->get_score();
          $mark = $stat->get_mark();

          //отмечаем данный тест как завершенный в бд
          $test_result = R::exec("UPDATE `user_test_result` SET `score_points`=?, `exam_points`=?, `test_status_id`='2', `last_finish_time`=? WHERE uid=? and test_id=?", [$score, $mark, $current_time, $_COOKIE['logged_user_id'], $test->id]);
        }
                
        //перенаправление на страницу результатов
        echo '<script>window.location.replace("results.php?id='. $test->id . ');</script>';
    }

    //var_dump($_POST);
    //var_dump($test);
?>

<!DOCTYPE html>
<html lang="ua">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
      
    <link rel="icon" type="image/png" href="https://findicons.com/files/icons/2770/ios_7_icons/512/brain.png" sizes="512x512">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,900&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap CSS (jsDelivr CDN) -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <!--Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <script src="../js/main.js"></script>

    <link rel="stylesheet" type="text/css" href="quiz_style.css">
    <title>
          <?php echo $test->name; ?>
    </title>
  </head>
  <body>
    <?php require "../blocks/header.php" ?>
    <div class="container col-lg-9 mx-auto">
      <div class="text-center mb-3 bg-light rounded p-2">
          <?php 
            //проводим тестирование
            if(isset($_GET['id']) && $test_sql)
            {              
              //если тест начат
              if(isset($_POST['start']) || isset($_POST['continue']))
              {
                //начат сначала
                if(isset($_POST['start']) && $authorised)
                {
                  //обнуляем все предыдущие результаты
                  R::exec("DELETE FROM `user_test_result` WHERE uid=? and test_id=?", [$_COOKIE['logged_user_id'], $test->id]);
                  unset($stat->previously_chosen_answer_ids);

                  //отмечаем время начала тестирования в бд
                  $current_time = date('Y-m-d H:i:s');

                  //добавляем инфу о текущем результате
                  R::exec("INSERT INTO `user_test_result`(uid, test_id, test_status_id, last_start_time) VALUES (?, ?, ?, ?)", [$_COOKIE['logged_user_id'], $test->id, 1, $current_time]);
                }

                

                //если вопросы впринципе присутствуют
                if($test->tickets): ?>

                        <!-- непосредственно пошаговая форма тестирования -->
                        <form id="testingForm" method="post">
                          <div class="card box-shadow">
                            <div class="card-header">
                              <h3 class="my-2"><?php echo $test->name; ?></h3>
                            </div>
                            <div class="bg-white rounded card-body">
                              <?php for($i = 0; $i < $test->tickets_amount; $i++): ?>
                                <!-- One "tab" for each step in the form: -->
                                <div class="tab">
                                  <?php if(!empty($test->tickets[$i]->picture_url))
                                                echo '<span><img class="w-50" style="max-width:300px;" src="../' . $test->tickets[$i]->picture_url .'"></span>'; ?>
                                  <p class="roboto font-weight-500 my-3"> <?php echo $i+1 . '. ' . $test->tickets[$i]->question; ?> </p>
                                  
                                  <div class="box my-0">
                                  <?php for($j = 0; $j < $test->tickets[$i]->answers_amount; $j++): ?>
                                    
                                      <input 
                                      class="form-check-input" 
                                      type="radio" 
                                      name=<?php echo $test->tickets[$i]->id; ?> 
                                      id=<?php echo ($i+1) . ($j+1) ?> 
                                      onclick='changeNextBtnName("Далі", <?php echo ($i == $test->tickets_amount-1) ? 1 : 0;?>, 
                                      <?php echo $test->tickets[$i]->id;?>, 
                                      <?php echo $test->tickets[$i]->answers[$j]->id;?>,
                                      <?php echo $test->id;?>, 
                                      <?php echo $uid = $authorised ? $_COOKIE['logged_user_id'] : -1;?>);' 
                                      value=<?php echo $test->tickets[$i]->answers[$j]->id; ?>
                                      <?php 
                                      //если подгрузилась история ранее выбранных ответов
                                      if(!empty($stat->previously_chosen_answer_ids)) 
                                      {
                                        //если текущий ответ был выбран ранее
                                        if(in_array($test->tickets[$i]->answers[$j]->id, $stat->previously_chosen_answer_ids))
                                          echo " checked";   //отмечаем как выбранный
                                      }
                                      ?>
                                      >
                                      <label class="form-check-label" for=<?php echo ($i+1) . ($j+1) ?>>
                                        <?php if(!empty($test->tickets[$i]->answers[$j]->picture_url))
                                                echo '<span><img src="../' . $test->tickets[$i]->answers[$j]->picture_url .'"></span>'; ?>
                                        <?php echo $test->tickets[$i]->answers[$j]->answer; ?>
                                      </label>
                                  <?php endfor; ?>
                                  </div>  
                                </div>
                              <?php endfor; ?>
                            </div>
                          </div>

                          <div class='row'>
                              <div class="col-md-6 mt-3"><button type="button" id="prevBtn" class="btn btn-outline-secondary px-5" onclick="nextPrev(-1)">Попереднє питання</button></div>
                              <div class="col-md-6 mt-3"><button type="button" id="nextBtn" class="btn btn-outline-primary px-5" onclick="nextPrev(1)">Пропустити</button></div>
                          </div>

                          <!-- Circles which indicates the steps of the form: -->
                          <div style="text-align:center;margin-top:40px;">
                            <?php for($i = 0; $i < $test->tickets_amount; $i++): ?>
                              <span class="step" id="step<?php echo $i; ?>" onclick="moveTo(this);"></span>
                            <?php endfor; ?>
                          </div>
                          <strong><span class="roboto" id="curTab">1/<?php echo $test->tickets_amount ?></span></strong>

                          <input type="hidden" name="send" value="<?php echo $uid = $authorised ? $_COOKIE['logged_user_id'] : '';?>" readonly>
                        </form>

                <?php endif;
              }
              //иначе отображаем начальную страничку теста
              else
              {
                  //(в процессе, завершен, со списка "пройти позже")
                  $test_status = array();

                  // сообщения о конфиге теста (для незарегистрированного / зарегистрированного пользователя)  
                  $test_info = array();

                  //если пользователь авторизован
                  if($authorised)
                  {
                      $uid =  $_COOKIE['logged_user_id'];

                      //если тест уже начали проходить
                      if($stat->status)
                      {
                        $in_favourite_list = $stat->in_favourite_list;
                        
                        if($in_favourite_list == 1)
                          $test_status[] = 'Зі списку "Пройти пізніше"';

                        switch ($stat->status) 
                        {
                          case '1':
                            $test_status[] = 'Ви вже почали проходити тест і не завершили його';
                            break;

                          case '2':
                            if($test->config->testing_for_exam_points)
                            {
                              //выводим оценку
                              $mark = $stat->get_mark();
                              $max_exam_points = $stat->get_max_exam_points();

                              $reward_name = "Оцінка";
                              if($max_exam_points > 0)
                              {
                                $mark_in_procents = (($mark/$max_exam_points) * 100);

                                $mark_msg = '<strong>' . number_format($mark, 2) . '</strong> із ' . $max_exam_points . ' балів <strong>(' . number_format($mark_in_procents, 1) . '%)</strong>';
                              }
                              else
                              {
                                $mark_msg = 'Оцінювання не було визначено автором тесту';
                              }
                            }
                            else
                            {
                              //показываем рейтинговые баллы
                              $score_points = $stat->get_score();
                              $max_score_points = $stat->get_max_score_points();

                              $reward_name = "Рейтингові бали";
                              if($max_score_points > 0)
                              {
                                $score_in_procents = (($score_points/$max_score_points) * 100);

                                $mark_msg = '<strong>' . number_format($score_points, 2) . '</strong> з ' . $max_score_points . ' можливих <strong>(' . number_format($score_in_procents, 1) . '%)</strong>';
                              }
                              else
                              {
                                $mark_msg = 'Нарахування рейтингових балів для цього тесту ще не було призначено адміністрацією сайту';
                              }               
                            }
                            $test_status[] = 'Завершено</br>' . $reward_name . ': ' . $mark_msg;
                            break;
                        }
                      }
                      //если тест не начали проходить
                      else
                      {
                        $test_status[] = ' ';     //отображаемый статус теста для юзера
                      }                
                    }
                    else
                    {
                          if($test->config->for_authorised_users_only)
                          {  
                            $test_status[] = '<h2 style="color:red;">Даний тест закритий для неавторизованих користувачів</h2>';
                            $closed = 1;
                          }                            

                          $test_info[] = '<strong>Ви не авторизувались на сайті, тож результати проходження тесту не будуть збережені</strong>';
                    }
                    
                    $test_info[] = "- - Параметри тестування: ";
                    
                    $max_exam_points_message = '';
                    //если включен режим экзамена (на оценку)
                    if($test->config->for_authorised_users_only)
                    {
                        $max_exam_points = 0;
                        foreach ($test->tickets as $ticket) 
                        {
                          $max_exam_points += $ticket->exam_points;
                        }

                        $max_exam_points_message = "Максимальна оцінка: " . $max_exam_points;
                    }

                    //если режим открытых ответов выключен
                    if($test->config->show_answers)
                    {
                        $test_info[] = "результат відповіді доступний одразу";
                    }
                    else
                    {
                        $test_info[] = "результати доступні тільки після здачі тесту";
                    }
                    
                    //если включено перемешивание вопросов
                    if($test->config->tickets_shuffle)
                    {
                        $test_info[] = "випадковий порядок запитань";
                    }

                    //если стоит ограничение по времени
                    if($test->config->time_constraint_is_active)
                    {
                        $sec = $test->config->time_constraint_in_seconds;

                        //форматируем время
                        if($sec > 59 && $sec <= 600)
                          $sec = gmdate("i хв s с", $sec);
                        else if($sec > 600)
                          $sec = gmdate("H год i хв s с", $sec);

                        $test_info[] = "встановлено обмеження за часом: <strong>" . $sec . "</strong>";
                    }              
                  

                //форматированное сообщение статуса теста, на вывод
                $status_message = '';
                for ($i=0; $i < sizeof($test_status); $i++) 
                { 
                  $status_message .= $test_status[$i] . "</br>";
                }

                //форматированное сообщение информации о тесте, на вывод
                $info_message = '';
                for ($i=0; $i < sizeof($test_info); $i++) 
                { 
                  $info_message .= "- " . $test_info[$i] . "</br>";
                }

                echo '<section class="ai-center">
                        <article class="mx-3 mb-3">
                          <img width=150px src="..' . $test->logo_url .'" title="' . $test->name . '">
                        </article>
                        <article class="mx-2 mb-2">
                          <div class="display-4">' . $test->name . '</div>
                        </article>
                        <article>
                          <span class="roboto h6">' . $max_exam_points_message . '</span>
                        </article>
                        <article class="my-3">
                          <span class="roboto">' . $status_message . '</span>
                        </article>
                        ';

                        if(!$closed)
                          //случай когда еще не проходили (с данного аккаунта)
                          if(!isset($stat) || !$stat->status)
                            {
                              echo '<article class="mb-5">
                                      <form action="" method="post">
                                        <button name="start" class="btn btn-primary py-2 px-5 mt-4"><span class="lead">Розпочати</span></button>
                                      </form>
                                    </article>';
                            }
                          //случай когда тест уже проходили (с данного аккаунта), предлагаем сбросить или продолжить
                          else
                          {
                               echo '<article class="mb-5">
                                      <form action="" method="post">
                                      <section class="d-flex flex-row">
                                          <button name="start" class="btn btn-outline-primary py-2 px-5 mt-4 mx-5"><span class="lead">Почати заново</span></button>';
                                //якщо тест не завершено
                                if($stat->status == 1)
                                  echo '<button name="continue" class="btn btn-primary py-2 px-5 mt-4 mx-5"><span class="lead">Продовжити</span></button>';
                                else
                                  echo '<a href="results.php?id='. $test->id .'" class="btn btn-primary py-2 px-5 mt-4 mx-5"><span class="lead">Результати</span></a>';
                                echo '</section>
                                      </form>
                                    </article>';
                          }

                echo    '
                        <hr width=100%>
                        <div class="row py-3 mx-auto">
                          <div class="alert alert-info alert-dismissible d-flex flex-column align-items-start fade show col-md-5 mx-auto mb-0" role="alert">
                            <article class="mb-2">
                              <i class="bi-info-circle-fill"></i>
                              <strong class="mx-2">Info</strong>
                            </article> 
                            <span class="text-start"><small>' . $info_message . '</small></span>
                          </div>
                          <div class="card-header text-start col-md-5 mx-auto p-3">
                           <span class="roboto">' . $test->description . '</span>
                          </div>
                        </div>
                        <hr width=100%>
                        
                        <section class="w-75">
                        <article class="as-start mb-1">
                          <span class="roboto font-weight-400">Автор тесту:    <strong>' . $test->author . '</strong></span></br>
                        </article>
                        <article class="as-start mb-1">
                          <span class="roboto font-weight-400">Дата створення:    <strong>' . $test->creating_date . '</strong></span></br>
                        </article>
                        <article class="as-start mb-1">
                          <span class="roboto font-weight-400">Кількість питань:    <strong>' . $test->tickets_amount . '</strong></span></br>
                        </article>
                        </div>
                      </section>
                      ';
                }
              }
          ?>
        </div>
    </div>

      
      <?php 
          //если начато тестирование, оживляем формы
          if((isset($_POST['start']) || isset($_POST['continue'])) && $test && $test->tickets_amount > 0) 
            require "js.php";
      ?>
  </body>
</html>