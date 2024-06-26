<?php 
    class Answer
    {
      public $id, $picture_url, $answer, $is_correct;

       public function __construct($answer_sql)
      {
        //если такой вопрос существует
        if($answer_sql)
        {
          $this->id = $answer_sql['id'];
          $this->picture_url = $answer_sql['picture_url'];
          $this->answer = $answer_sql['answer'];
          $this->is_correct = $answer_sql['is_correct'];
        }
        else
        {
          $errors[] = "Такого варіанту відповіді не існує. Поверніться, будь-ласка, на <a href='../index.php' style='text-decoration:none;'>головну</a>";
        }
      }
    }

    class Ticket
    {
      public $id, $question, $picture_url, $reward_score_points, $exam_points, $ticket_type_id, $answers_amount;

      //массив обьектов класса answer (список возможных ответов)
      public $answers = array();

      public function __construct($ticket_sql)
      {
        //если такой вопрос существует
        if($ticket_sql)
        {
          $this->id = $ticket_sql['id'];
          $this->picture_url = $ticket_sql['picture_url'];
          $this->question = $ticket_sql['question'];
          $this->reward_score_points = $ticket_sql['reward_score_points'];
          $this->exam_points = $ticket_sql['exam_points'];
          $this->ticket_type_id = $ticket_sql['ticket_type_id'];

          $answers_sql = R::getAll("select * from answer where ticket_id = $this->id");
          //если вопросы к данному тесту существуют
          if($answers_sql)
          {
            $this->answers_amount = sizeof($answers_sql) ? sizeof($answers_sql) : 0;

            foreach ($answers_sql as $value)
            {
              $answer = new Answer($value);
              array_push($this->answers, $answer);
            }
          }
        }
        else
        {
          $errors[] = "Такого питання не існує. Поверніться, будь-ласка, на <a href='../index.php' style='text-decoration:none;'>головну</a>";
        }
      }
    }
    
    //конфиг теста (для удобства вынесен в структуру, виден только в классе Test)
    class TestConfig
    {
        public  $show_answers, $testing_for_exam_points, 
                $time_constraint_is_active, $time_constraint_in_seconds,
                $tickets_shuffle, $for_authorised_users_only;

        public function __construct($show_answers, $testing_for_exam_points, 
                $time_constraint_is_active, $time_constraint_in_seconds,
                $tickets_shuffle, $for_authorised_users_only)
        {
          $this->show_answers = $show_answers;
          $this->testing_for_exam_points = $testing_for_exam_points;
          $this->time_constraint_is_active = $time_constraint_is_active;
          $this->time_constraint_in_seconds = $time_constraint_in_seconds;
          $this->tickets_shuffle = $tickets_shuffle;
          $this->for_authorised_users_only = $for_authorised_users_only;
        }
    }

    class Test
    {
      public $id, $name, $description, $author_id, $author, $category_id, $category, $creating_date, $logo_url, $tickets_amount;
      
      //массив обьектов класса Ticket (список вопросов)
      public $tickets = array();

      //конфиг теста (для удобства вынесен в структуру)
      public $config;
      
      public function __construct($test_sql)
      {
        //если такой тест существует
        if($test_sql)
        {
          $this->id = $test_sql['id'];
          $this->name = $test_sql['name'];
          $this->description = $test_sql['description'];
          $this->author_id = $test_sql['author_id'];
          $this->category_id = $test_sql['test_category_id'];
          $this->creating_date = $test_sql['creating_date'];
          $this->logo_url = $test_sql['logo_url'];
          $this->config = new TestConfig(
                                  $test_sql['show_answers'], $test_sql['testing_for_exam_points'], 
                                  $test_sql['time_constraint_is_active'], $test_sql['time_constraint_in_seconds'],
                                  $test_sql['tickets_shuffle'], $test_sql['for_authorised_users_only']
                                );
          
          //если у теста поле id установлено в null, то считаем что мы - его создатели (teststogo.crew)
          $this->author = empty($this->author_id) ? 'teststogo.crew' : R::getRow("select * from user where id = $this->author_id")['username'];
          $this->category = R::getRow("select * from test_category where id = $this->category_id")['name'];
          
          $tickets_sql = R::getAll("select * from ticket where test_id = $this->id");
          //если вопросы к данному тесту существуют
          if($tickets_sql)
          {
            $this->tickets_amount = sizeof($tickets_sql) ? sizeof($tickets_sql) : 0;

            foreach ($tickets_sql as $value)
            {
              $ticket = new Ticket($value);
              array_push($this->tickets, $ticket);
            }

            //если включен режим перемешивания вопросов
            if ($this->config->tickets_shuffle) 
            {
              shuffle($this->tickets);
            }
          }
          
        }
        else
        {
          $errors[] = "Такого тесту не існує. Поверніться, будь-ласка, на <a href='../index.php' style='text-decoration:none;'>головну</a>";
        }
      }
    }

    //расширение класса интервала с функцией корректного пересчета интервала (3600с -> 1ч)
    class DateIntervalEnhanced extends DateInterval 
      {
          public function recalculate()
          {
              $from = new DateTime;
              $to = clone $from;
              $to = $to->add($this);
              $diff = $from->diff($to);
              foreach ($diff as $k => $v) $this->$k = $v;
              return $this;
          }
      }

    //для обощенной работы с тестом и активностью авторизованного пользователя
    class Stat
    {
      public $test, $uid, $previously_chosen_answer_ids, 
             $correct_answer_ids, $status, $in_favourite_list;

      public function __construct($test = array(), $uid = null)
      {
        if($test)
        {
          $this->test = $test;
          $this->uid = $uid;
          $this->previously_chosen_answer_ids = array();
          $this->correct_answer_ids = $this->get_correct_answer_ids();

          if($this->uid)
          {
            //загрузка истории выбранных ответов
            $this->previously_chosen_answer_ids = $this->get_previously_chosen_answer_ids();

            $this->status = R::getRow("select test_status_id, in_favourite_list from user_test_result where test_id = ? and uid = ?", [$this->test->id, $this->uid]);
                      
            //если пользователь уже начинал проходить этот тест
            if($this->status)
            {
                $this->in_favourite_list = $this->status['in_favourite_list']; 
                $this->status = $this->status['test_status_id'];
            }
          }
        }
      }

      public static function time_since_registered($uid)
      {
        $result = '';

        $register_time = R::getRow("select creating_date from `user` where id=?", [$uid]);
        if($register_time)
          $register_time = $register_time['creating_date'];
        else
          return $result;
        
        $current_time = date("Y-m-d H:i:s");

        $difference = Stat::get_formatted_datetime_difference_from_sql($current_time, $register_time);
        $search = "дн.";

        //позиция в строке после слова $search
        $position = mb_strpos($difference, $search) + mb_strlen($search);

        //получаем значение строки до дней
        if(mb_strpos($difference, $search) > 0)   //если было найдено слово $search (зареган на сайте более суток)
          $result = mb_substr($difference, 0, $position);
        else
          $result = '0 дн.';

        return $result;
      }

      public static function get_formatted_datetime_from_sql($sql_datetime)
      {
        // creating new date objects
        $datetime = new DateTime($sql_datetime);

        //now you can use format on that objects:
        return $datetime->format('d.m.Y H:i:s');
      }

      public static function get_formatted_date_from_sql($sql_datetime)
      {
        // creating new date objects
        $datetime = new DateTime($sql_datetime);

        //now you can use format on that objects:
        return $datetime->format('d.m.Y');
      }

      public static function get_dateinterval_message($interval)
      {
        $difference = [
                        "day" => $interval->format('%d'),
                        "month" => $interval->format('%m'),
                        "year" => $interval->format('%y'),
                        "h" => $interval->format('%h'),
                        "m" => $interval->format('%i'),
                        "s" => $interval->format('%s')
                      ];
        //форматированное сообщение на вывод
        $dateinterval_msg = '';
        
        if($difference['day'] > 0)
          $dateinterval_msg .= $difference['day'] . ' дн. ';
        if($difference['month'] > 0)
          $dateinterval_msg .= $difference['month'] . ' міс. ';
        if($difference['year'] > 0)
          $dateinterval_msg .= $difference['year'] . ' р. ';
        if($difference['h'] > 0)
          $dateinterval_msg .= $difference['h'] . ' год. ';
        if($difference['m'] > 0)
          $dateinterval_msg .= $difference['m'] . ' хв. ';
        if($difference['s'] > 0)
          $dateinterval_msg .= $difference['s'] . ' сек. ';

        return $dateinterval_msg;
      }

      //(a - b) datetime difference
      public static function get_formatted_datetime_difference_from_sql($a, $b)
      {
        $a = new DateTime($a);
        $b = new DateTime($b);
        $diff = $a->diff($b);

        return Stat::get_dateinterval_message($diff);
      }

      public static function get_user_intest_time($uid)
      {
        $total_time = '-';
        $today = new DateTime(date("Y-m-d H:i:s"));
        $diff_sec = 0;

        $user_stat = R::getAll('select last_finish_time, last_start_time from user_test_result where uid=?', [$uid]);
        if($user_stat)
        {
          foreach ($user_stat as $row) 
          {
            $finish = new DateTime($row['last_finish_time']);
            $start = new DateTime($row['last_start_time']);
            $diff_sec += intval(($finish->diff($start))->format('%s'));
          }
          $diff_sec = new DateIntervalEnhanced("PT".$diff_sec."S");
          $total_time = Stat::get_dateinterval_message($diff_sec->recalculate());
        }
        
        return $total_time;
      }

      public function get_reward_name_and_mark_msg($uid, $test_id)
      {
        $test = new Test(R::getRow('select * from test where id = ?', [$test_id]));
        $mark = $this->get_mark($uid, $test_id);
        $max_exam_points = $this->get_max_exam_points($test_id);
        $score_points = $this->get_score($uid, $test_id);
        $max_score_points = $this->get_max_score_points($test_id);

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

        return array("reward_name"=>$reward_name, "mark_msg"=>$mark_msg);
      }

      public function get_previously_chosen_answer_ids()
      {
        $previously_chosen_answer_ids = array();

        //подгрузка истории тестирования
        $previous_user_test_result = R::getRow("select id from user_test_result where test_id=? and uid=?", [$this->test->id, $this->uid]);

        //получаем id записи о результате прохождения теста пользователем
        if(isset($previous_user_test_result['id']))
          {
            $previous_user_test_result_id = $previous_user_test_result['id'];
            //получаем массив результатов вопросов, на которые ранее были даны ответы
            $previous_ticket_results = R::getAll("select id from ticket_result where user_test_result_id=? order by id", [$previous_user_test_result_id]);

            //получаем их id
            $previous_ticket_results_ids = array();
            foreach ($previous_ticket_results as $previous_ticket_result) 
            {
              $previous_ticket_results_ids[] = $previous_ticket_result['id'];
            }

            //получаем массив ранее выбранных ответов (историю)
            $previously_chosen_answers = array();
            foreach ($previous_ticket_results_ids as $previous_ticket_result_id) 
            {
              $previously_chosen_answers[] = R::getRow("select chosen_answer_id from answer_result where ticket_result_id=?", [$previous_ticket_result_id]);
            }
            
            //получаем их id
            $previously_chosen_answer_ids = array();
            foreach ($previously_chosen_answers as $previously_chosen_answer) 
            {
              $previously_chosen_answer_ids[] = $previously_chosen_answer['chosen_answer_id'];
            }
          }

        return $previously_chosen_answer_ids;
      }

      public function get_correct_answer_ids()
      {
        $correct_answer_ids = array();

        //загрузка верных ответов к тесту
        foreach($this->test->tickets as $ticket)
          foreach ($ticket->answers as $answer) 
          {
            if($answer->is_correct)
            {
              $correct_answer_ids[] = $answer->id;
            }
          }

        return $correct_answer_ids;
      }

      //оценивание вопроса (пока только в плане корректно ответили / некорректно)
      public function check_the_answer($ticket_id)
      {
        //подгрузка истории тестирования
        $user_test_result = R::getRow("select id from user_test_result where test_id=? and uid=?", [$this->test->id, $this->uid]);

        //получаем id записи о результате прохождения теста пользователем
        if(isset($user_test_result['id']))
          $user_test_result_id = $user_test_result['id'];
                  
        //получаем результат рассматриваемого вопроса
        $ticket_result = R::getRow("select id from ticket_result where user_test_result_id=? and ticket_id=? order by id", [$user_test_result_id, $ticket_id]);

        if($ticket_result)
        {
          //получаем его id
          $ticket_result_id = $ticket_result['id'];

          //получаем ранее выбранный ответ
          $chosen_answer = R::getRow("select chosen_answer_id from answer_result where ticket_result_id=?", [$ticket_result_id]);
          
          //получаем его id
          $chosen_answer_id = $chosen_answer['chosen_answer_id'];

          //проверяем правильность ответа
          if(in_array($chosen_answer_id, $this->correct_answer_ids))
            return 1;
          
          return 0;
        }
        //если на вопрос не ответили
        else
          return -1;
      }

      public function get_correct_answer($ticket_id)
      {
        //поиск правильного ответа
        foreach ($this->test->tickets as $ticket) 
        {
          if($ticket->id == $ticket_id)
          {
            foreach ($ticket->answers as $answer) 
            {
              if($answer->is_correct)
                return $answer;
            }
            break;
          }
        }
      }

      //метод получения айди ответов на вопросы к результату текущего прохождения теста
      public function get_chosen_answer_ids($uid = null, $test_id = null)
      {
        //массив ранее выбранных ответов
        $chosen_answer_ids = array();

        if(is_null($test_id) and is_null($uid))
        {
          $test_id = $this->test->id;
          $uid = $this->uid;
        }

        //результат текущего прохождения теста
        $user_test_result = R::getRow("select id from user_test_result where test_id=? and uid=?", [$test_id, $uid]);

        //получаем id записи о результате прохождения теста пользователем
        if(isset($user_test_result['id']))
          $user_test_result_id = $user_test_result['id'];
        else
          return $chosen_answer_ids;
                  
        //получаем массив результатов вопросов, на которые ранее были даны ответы
        $ticket_results = R::getAll("select id from ticket_result where user_test_result_id=? order by id", [$user_test_result_id]);

        //получаем их id
        $ticket_results_ids = array();
        foreach ($ticket_results as $ticket_result) 
          $ticket_results_ids[] = $ticket_result['id'];

        //получаем массив ранее выбранных ответов (историю)
        $chosen_answers = array();
        foreach ($ticket_results_ids as $ticket_result_id) 
          $chosen_answers[] = R::getRow("select chosen_answer_id from answer_result where ticket_result_id=?", [$ticket_result_id]);
                  
        //получаем их id
        foreach ($chosen_answers as $chosen_answer) 
          $chosen_answer_ids[] = $chosen_answer['chosen_answer_id'];

        return $chosen_answer_ids;
      }

      public function get_max_exam_points($test_id = null)
      {
        if(is_null($test_id))
        {
          $test_id = $this->test->id;
        }
        $test = new Test(R::getRow("select * from test where id=?", [$test_id]));

        //вычисление макс оценки за экзамен
        $max_exam_points = 0;
        foreach ($test->tickets as $ticket) 
            $max_exam_points += $ticket->exam_points;
        
        return $max_exam_points;
      }

      public function get_max_score_points($test_id = null)
      {
        if(is_null($test_id))
        {
          $test_id = $this->test->id;
        }
        $test = new Test(R::getRow("select * from test where id=?", [$test_id]));

        //макс к-ство рейтинговых баллов
        $max_score_points = 0;
        foreach ($test->tickets as $ticket) 
            $max_score_points += $ticket->reward_score_points;

        return $max_score_points;
      }

      public function get_mark($uid = null, $test_id = null)
      {
        if(is_null($test_id) and is_null($uid))
        {
          $test_id = $this->test->id;
          $uid = $this->uid;
        }

        //вычисление полученной оценки за экзамен
        $mark = 0;

        $chosen_answer_ids = $this->get_chosen_answer_ids($uid, $test_id);
                
        foreach ($chosen_answer_ids as $chosen_answer_id) 
        {
          $answer = R::getRow("select * from answer where id=?", [$chosen_answer_id]);
          $answer_is_correct = $answer['is_correct'];
          $answer_ticket_id = $answer['ticket_id'];

          $ticket = R::getRow("select * from ticket where id=?", [$answer_ticket_id]);
          $ticket_exam_points = $ticket['exam_points'];

          //если ответили правильно, начисляем баллы
          if($answer_is_correct)
            $mark += $ticket_exam_points;
        }

        return $mark;
      }

      public function get_score($uid = null, $test_id = null)
      {
        if(is_null($test_id) and is_null($uid))
        {
          $test_id = $this->test->id;
          $uid = $this->uid;
        }

        //вычисление полученных рейтинговых баллов
        $score = 0;

        $chosen_answer_ids = $this->get_chosen_answer_ids($uid, $test_id);

        foreach ($chosen_answer_ids as $chosen_answer_id) 
        {
          $answer = R::getRow("select * from answer where id=?", [$chosen_answer_id]);
          $answer_is_correct = $answer['is_correct'];
          $answer_ticket_id = $answer['ticket_id'];

          $ticket = R::getRow("select * from ticket where id=?", [$answer_ticket_id]);
          $ticket_score_points = $ticket['reward_score_points'];

          //если ответили правильно, начисляем баллы
          if($answer_is_correct)
            $score += $ticket_score_points;
        }

        return $score;
      }

      public function get_correct_answers_amount()
      {
        $correct_answers_amount = 0;

        $chosen_answer_ids = $this->get_chosen_answer_ids();
                
        foreach ($chosen_answer_ids as $chosen_answer_id) 
        {
          $answer = R::getRow("select * from answer where id=?", [$chosen_answer_id]);
          $answer_is_correct = $answer['is_correct'];
          $answer_ticket_id = $answer['ticket_id'];

          $ticket = R::getRow("select * from ticket where id=?", [$answer_ticket_id]);

          //подсчитываем количество правильных ответов
          if($answer_is_correct)
              $correct_answers_amount += 1;
        }

        return $correct_answers_amount;
      }

      public function get_status($test_status_id)
      {
        return R::getRow("select name from test_status WHERE id=?", [$test_status_id])['name'];
      }
    }
?>