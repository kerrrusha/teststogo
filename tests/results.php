<?php 
	require_once "../libs/rb.php";           //подключение библиотеки RedBean PHP
    require "../blocks/db.php"; 
    require "class_description.php";

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

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap CSS (jsDelivr CDN) -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <!--Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <script src="../js/main.js"></script>

    <link rel="stylesheet" type="text/css" href="quiz_style.css">
    <title>
        <?php echo $test->name; ?> (результати)
    </title>
</head>
<body>
	<?php require "../blocks/header.php" ?>
	<div class="container col-lg-9 mx-auto">
      <div class="text-center mb-3 bg-light rounded p-2">
	<?php 
		if(isset($_COOKIE['logged_user_id']))
                {
                  //var_dump($_POST);
                  $uid = $_COOKIE['logged_user_id'];
                  $current_time = date('Y-m-d H:i:s');

                  $user_test_result = R::getRow("select * from user_test_result WHERE uid=? and test_id=?", [$_COOKIE['logged_user_id'], $test->id]);

                  $formatted_last_start_time = $stat->get_formatted_datetime_from_sql($user_test_result['last_start_time']);
                  $formatted_last_finish_time = $stat->get_formatted_datetime_from_sql($user_test_result['last_finish_time']);

                  $difference_msg = $stat->get_formatted_datetime_difference_from_sql($user_test_result['last_finish_time'], $user_test_result['last_start_time']);

                  $status = $stat->get_status($user_test_result['test_status_id']);

                  //вычисление макс оценки за экзамен
                  $max_exam_points = $stat->get_max_exam_points();

                  //макс к-ство рейтинговых баллов
                  $max_score_points = $stat->get_max_score_points();

                  //вычисление полученных баллов за экзамен
                  $mark = $stat->get_mark();
                  $score_points = $stat->get_score();

                  //количество правильных ответов
                  $correct_answers_amount = $stat->get_correct_answers_amount();

                  //общее количество вопросов
                  $questions_amount = $test->tickets_amount;

                  $mark_msg = '';
                  //если установлен режим экзамена
                  if($test->config->testing_for_exam_points)
                  {
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
                  
                  echo '<div class="container col-lg-6 mx-auto">
                          <div class="card-header">
                            <h3 class="my-2">' . $test->name . '</h3>
                          </div>
                          <table class="table table-hover table-bordered">
                            <tbody>
                              <tr>
                                <th scope="row">Тест розпочато</th>
                                <td>' . $formatted_last_start_time . '</td>
                              </tr>
                              <tr>
                                <th scope="row">Стан</th>
                                <td>' . $status . '</td>
                              </tr>
                              <tr>
                                <th scope="row">Завершено</th>
                                <td>' . $formatted_last_finish_time . '</td>
                              </tr>
                              <tr>
                                <th scope="row">Час виконання</th>
                                <td>' . $difference_msg . '</td>
                              </tr>
                              <tr>
                                <th scope="row">' . $reward_name . '</th>
                                <td>' . $mark_msg . '</td>
                              </tr>
                            </tbody>
                          </table>
                        
                          <section class="successBar p-0" style="white-space: nowrap;">';
                        //если процент неправильных ответов больше нуля
                        if(100 * ($correct_answers_amount / $questions_amount) > 0)
                          echo '
                            <article class="correct" style="width:' . 100 * ($correct_answers_amount / $questions_amount) . '%;">
                              ' . number_format(100 * ($correct_answers_amount / $questions_amount), 1) . '% (' . $correct_answers_amount . ')
                            </article>';
                        //если процент неправильных ответов больше нуля
                        if(100 - 100 * ($correct_answers_amount / $questions_amount) > 0)
                        {
                          echo '
                            <article class="incorrect" style="width:' . 100 * (1 - $correct_answers_amount / $questions_amount) . '%;">
                              ' . number_format(100 * (1 - $correct_answers_amount / $questions_amount), 1) . '% ('.($questions_amount - $correct_answers_amount).')
                            </article>';
                        }

                        echo  '</section>

                          <div class="display-5 my-3">Результати</div>

                          <div>';

                    //вывод результатов ответов по каждому вопросу
                    for($i = 0; $i < $test->tickets_amount; $i++)
                    {
                        echo   '<div class="bg-white rounded card-body border mb-3 p-0 px-3">';
                        
                        //если есть картинка выводим ее
                        if(!empty($test->tickets[$i]->picture_url))
                            echo '<span><img src="../' . $test->tickets[$i]->picture_url .'"></span>';
                        
                        echo '<p class="roboto font-weight-500 my-3">' . $i+1 . '. ' . $test->tickets[$i]->question . ' </p>
                                        <div class="box my-0">';
                        for($j = 0; $j < $test->tickets[$i]->answers_amount; $j++)
                        {
                          echo '          <input  
                                          type="radio" 
                                          name=' . $test->tickets[$i]->id . ' 
                                          id=' . ($i+1) . ($j+1) . ' 
                                          value=' . $test->tickets[$i]->answers[$j]->id;
                                          
                          //если подгрузилась история ранее выбранных ответов
                          if(!empty($stat->previously_chosen_answer_ids)) 
                          {
                            //если текущий ответ был выбран ранее
                            if(in_array($test->tickets[$i]->answers[$j]->id, $stat->previously_chosen_answer_ids))
                                echo " checked";   //отмечаем как выбранный
                          }
                          
                          echo '      disabled    
                                          >
                                          <label for=' . ($i+1) . ($j+1) . '>';
                          //если есть изображение - выводим его
                          if(!empty($test->tickets[$i]->answers[$j]->picture_url))
                              echo '<span><img src="../' . $test->tickets[$i]->answers[$j]->picture_url .'"></span>'; 
                          
                          echo  $test->tickets[$i]->answers[$j]->answer . '</label>';
                        }
                        echo '  </div>';

                        //если ответили верно
                        if($stat->check_the_answer($test->tickets[$i]->id) == 1)
                        {
                          echo '<section class="alert alert-success alert-dismissible d-flex flex-column align-items-start fade show mt-3">
                                    <article>
                                      <i class="bi-check-circle-fill"></i>
                                      <strong class="mx-2">Ваша відповідь правильна.</strong>
                                    </article> 
                                </section>';
                        }
                        //если ответили неверно
                        else if($stat->check_the_answer($test->tickets[$i]->id) == 0)
                        {
                          echo '<section class="alert alert-danger alert-dismissible d-flex flex-column align-items-start fade show mt-3">
                                    <article class="mb-2">
                                      <i class="bi-exclamation-octagon-fill"></i>
                                      <strong class="mx-2">Ваша відповідь неправильна.</strong>
                                    </article> 
                                    <span class="text-start"><small>Правильна відповідь: ' . $stat->get_correct_answer($test->tickets[$i]->id)->answer . '</small></span>
                                </section>';
                        }
                        else
                        //если пропустили вопрос
                        {
                          echo '<section class="alert alert-danger alert-dismissible d-flex flex-column align-items-start fade show mt-3">
                                    <article>
                                      <i class="bi-exclamation-octagon-fill"></i>
                                      <strong class="mx-2">Питання пропущено.</strong>
                                    </article> 
                                </section>';
                        }

                        echo '</div>';
                        }
                        echo  '</div>
                            </div>';
                    }
                    else
                    {
                      echo '<p class="display-3">Дякуємо!</p></br>
                            <p>Для отримання більш детальних результатів, зберігання історії тестувань, ведення статистики - зареєструйтесь на нашому сайті</p>';
                    }
	?>
		</div>
	</div>
	<?php require("../blocks/footer.php"); ?>
</body>
</html>