<?php 
	  require_once "../libs/rb.php";           //подключение библиотеки RedBean PHP
    require "../blocks/db.php"; 

	//echo "here";		//для дебага, отобразится в response

    //если идет тест и был выбран какой то ответ
    if( isset($_POST['current_ticket_id']) && 
    	isset($_POST['current_answer_id']) && 
    	isset($_POST['uid']) && 
    	isset($_POST['test_id'])
      )
    {
            //заносим результат в базу данных
            $uid = $_POST['uid'];
			      $test_id = $_POST['test_id'];
            $current_ticket_id = $_POST['current_ticket_id'];
            $current_answer_id = $_POST['current_answer_id'];

              $previous_test_result = R::getRow('select * from `user_test_result` where `uid`=? and `test_id`=?', [$uid, $test_id]);

              //если тест уже проходили
              if($previous_test_result)
              {
                //загружаем его для последующего обновления
                $previous_test_result = R::load('user_test_result', $previous_test_result['id']);

                $previous_test_result->test_status_id = 1;

                $user_test_result_id = R::store($previous_test_result);
              }
              else
              {
                //добавляем запись
                R::exec("INSERT INTO `user_test_result`(uid, test_id, test_status_id) VALUES (?, ?, ?)", [$uid, $test_id, 1]);

                $user_test_result_id = R::getRow('select * from `user_test_result` where `uid`=? and `test_id`=?', [$uid, $test_id])['id'];
              }

              //отмечаем выбранный ответ к данному вопросу
              $previous_ticket_result = R::getRow('select * from ticket_result where user_test_result_id=? and ticket_id=?', [$user_test_result_id, $current_ticket_id]);
              
              //если такой вопрос еще не проходился
              if(!$previous_ticket_result)
              {
                //добавляем запись
                R::exec("INSERT INTO `ticket_result`(user_test_result_id, ticket_id) VALUES (?, ?)", [$user_test_result_id, $current_ticket_id]);

                $ticket_result_id = R::getRow('select * from ticket_result where user_test_result_id=? and ticket_id=?', [$user_test_result_id, $current_ticket_id])['id'];
              }
              else
              {
                $ticket_result_id = $previous_ticket_result['id'];
              }

              $previous_answer_result = R::getRow('select * from answer_result where ticket_result_id=?', [$ticket_result_id]);

              //если ответ уже был дан
              if($previous_answer_result)
              {
                //загружаем его для последующего обновления
                $previous_answer_result = R::load('answer_result', $previous_answer_result['id']);

                $previous_answer_result->chosen_answer_id = $current_answer_id;

                $answer_result_id = R::store($previous_answer_result);
              }
              //если такого ответа еще не было
              else
              {  	
				//добавляем запись
                R::exec("INSERT INTO `answer_result`(ticket_result_id, chosen_answer_id) VALUES (?, ?)", [$ticket_result_id, $current_answer_id]);

                $answer_result_id = R::getRow('select * from answer_result where chosen_answer_id=? and ticket_result_id=?', [$current_answer_id, $ticket_result_id]);
              }            
    }
?>