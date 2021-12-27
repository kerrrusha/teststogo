<style type="text/css">
	th, td
	{
		font-weight: normal!important;
		vertical-align: middle!important;
	}
</style>

<!-- если авторизован -->
<?php if(isset($_COOKIE['logged_user_id'])) : 
	$uid = $_COOKIE['logged_user_id'];
	$user = R::getRow('select * from user where id = ?', [$uid]);

	$stat = new Stat();
?>
	<div class="container col-lg-9 mx-auto">
	<div class='my-3 d-flex flex-row justify-content-around align-items-center'>
		<h2 class="mb-4 display-4">Вітаю, <?php echo $_COOKIE['logged_user']; ?>.</h2>
		<span><a class="btn btn-outline-primary" href="/id/signout.php">Вийти</a></span>
	</div>
	<div class="row">
	  <div class="nav flex-column nav-pills me-5 col-md-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
	  	<button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true">Профіль</button>
	    <button class="nav-link" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="false">Кабінет</button>
	    <button class="nav-link" id="v-pills-review-tab" data-bs-toggle="pill" data-bs-target="#v-pills-review" type="button" role="tab" aria-controls="v-pills-review" aria-selected="false">Результати</button>
	    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Мої тести</button>
	  </div>
	  <div class="tab-content col-md-9" id="v-pills-tabContent">
	  	<div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
	  		<div class="container mx-auto p-3 bg-light">
	    		<table class="table">
	    			<tbody>
	    				<tr>
	    					<th scope=col style="border:0px;">
	    						<h4 class="mb-3">Фото профіля</h4>
	    						<img src="<?php echo $user['avatar_url']; ?>" class="img-thumbnail" style="width:100px"></br>
	    						<div class="btn-group">
								  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								    Редагувати
								  </button>
								  <ul class="dropdown-menu">
								    <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#upload">Завантажити</a></button>
								    <li><a class="dropdown-item" href="#">Видалити</a></li>
								  </ul>
								</div>

								<!-- popup окно загрузки аватара -->
								<!-- Modal -->
								<div class="modal" id="upload" tabindex="-1">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title">Фото профіля</h5>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <form action="blocks/upload_avatar.php" method="post" enctype="multipart/form-data">
								      <div class="modal-body">
								        <!-- загружаем изображение на сайт -->
								        <label class="form-label" for="customFile">Завантажте зображення <strong>jpg</strong> формату</label>
								        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" />
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
								        <button type="submit" name="submit" class="btn btn-primary">Встановити</button>
								      </div>
								      </form>
								    </div>
								  </div>
								</div>
	    					</th>
	    				</tr>
	    				<tr>
	    					<th scope=col style="border:0px;">
	    						</br><h4>Активність</h4>
	    					</th>
	    				</tr>
	    				<tr>
	    					<th scope="col">Аккаунт створено:</th>
	    					<td><?php echo Stat::get_formatted_date_from_sql($user['creating_date']); ?></td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Тестів пройдено:</th>
	    					<td><?php echo R::getRow("select count(*) as count from `user_test_result` where uid=?", [$uid])['count']; ?></td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Час, проведений в тестуваннях:</th>
	    					<td><?php echo Stat::get_user_intest_time($uid); ?></td>
	    				</tr>
	    			</tbody>
	    		</table>
	    	</div>
	  	</div>
	    <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
	    	<div class="container mx-auto p-3 bg-light">
	    		<table class="table">
	    			<tbody>
	    				<tr>
	    					<th scope=col style="border:0px;">
	    						<h4>Особисті дані</h4>
	    					</th>
	    				</tr>
	    				<tr>
	    					<th scope="col">Ім'я користувача:</th>
	    					<td><?php echo $user['username'] ?></td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Пароль:</th>
	    					<td><a href="">Змінити пароль...</a></td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Дата народження:</th>
	    					<td>
	    					<?php  
	    						$date = DateTime::createFromFormat('j-n-Y', $user['birthday'].('-').$user['birthmonth'].('-'). $user['birthyear']); 
	    						echo $date->format('d.m.Y');
	    					?>	    						
	    					</td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Стать:</th>
	    					<td><?php echo $sex = $user['sex'] == 0 ? 'Жіноча' : 'Чоловіча' ?></td>
	    				</tr>
	    				<tr>
	    					<th scope=col style="border:0px;">
	    						</br><h4>Параметри пошти</h4>
	    					</th>
	    				</tr>
	    				<tr>
	    					<th scope="col">Пошта:</th>
	    					<td><?php echo $user['login'] ?></td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Підтвердження електронної адреси:</th>
	    					<td><div class="alert alert-danger p-1 text-center m-0">Не підтверджено</div></td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Отримувати корисні сповіщення:</th>
	    					<td><div class="form-check form-switch d-flex align-items-center">
							  <input class="form-check-input p-0" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
							</div></td>
	    				</tr>
	    			</tbody>
	    		</table>
	    	</div>
	    </div>
	    <div class="tab-pane fade" id="v-pills-review" role="tabpanel" aria-labelledby="v-pills-review-tab">
	    	<!-- результаты по тестам -->
	    	<?php 
	    		$completed = R::getAll('select * from user_test_result where uid = ? and test_status_id = 2 order by last_finish_time desc', [$uid]);
	    		$in_process = R::getAll('select * from user_test_result where uid = ? and test_status_id = 1 order by last_finish_time desc', [$uid]);
	    		$favourite = R::getAll('select * from user_test_result where uid = ? and in_favourite_list = 1 order by last_finish_time desc', [$uid]);
	    	?>
	    	<div class="accordion" id="accordionExample">
			  <div class="accordion-item stretched">
			    <h2 class="accordion-header" id="headingOne">
			      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			        <div class="h4 m-0">Завершені тести</div>
			        <div class="h5 text-dark my-0" style="position:absolute;right:50px;">
			        	<?php echo sizeof($completed); ?>
			        </div>
			      </button>
			    </h2>
			    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
			      <div class="accordion-body">
			        <?php 
			        foreach ($completed as $row):
						$test = R::getRow('select * from test where id = ?', [$row['test_id']]);
					    $result = $stat->get_reward_name_and_mark_msg($uid, $row['test_id']);
			        ?>
			        <div class="card my-3 rounded-3 shadow-sm d-flex flex-row align-items-center">
			          <div class="mx-3">
					        <img src='<?php echo $test['logo_url'] ?>' width=50px title="">
					  </div>
			          <div class="card-body p-2">
			            <h4 class="mb-1"><?php echo $test['name'] ?></h4>
			            <div class="lead"><?php echo $result['reward_name'] . ': ' . $result['mark_msg'] ?></div>
			            <small>Завершено: <?php echo Stat::get_formatted_datetime_from_sql($row['last_finish_time']); ?></small>
			          </div>
			          <a href="tests/results.php?id=<?php echo $test['id']; ?>" class="stretched-link"></a>
			        </div>
			    	<?php endforeach; ?>
			      </div>
			    </div>
			  </div>
			  <div class="accordion-item">
			    <h2 class="accordion-header" id="headingTwo">
			      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			        <div class="h4 m-0">В процесі</div>
			        <div class="h5 text-dark my-0" style="position:absolute;right:50px;">
			        	<?php echo sizeof($in_process); ?>
			        </div>
			      </button>
			    </h2>
			    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
			      <div class="accordion-body">
			        <?php 
			        foreach ($in_process as $row):
						$test = R::getRow('select * from test where id = ?', [$row['test_id']]);
						
						//количество пройденных вопросов
						$completed_amount = sizeof(R::getAll('select id from ticket_result where user_test_result_id=?', [$row['id']]));
						//общее к-ство вопросов
						$total_amount = sizeof(R::getAll('select id from ticket where test_id = ?', [$row['test_id']]));
			        ?>
			        <div class="card my-3 rounded-3 shadow-sm d-flex flex-row align-items-center">
			          <div class="mx-3">
					        <img src='<?php echo $test['logo_url'] ?>' width=50px title="">
					  </div>
			          <div class="card-body p-2">
			            <h4 class="mb-1"><?php echo $test['name'] ?></h4>
			            <div class="lead">Пройдено: <?php echo $completed_amount . ' з ' . $total_amount ?> питань</div>
			            <small>Розпочато: <?php echo Stat::get_formatted_datetime_from_sql($row['last_start_time']); ?></small>
			          </div>
			          <a href="tests/quiz.php?id=<?php echo $test['id']; ?>" class="stretched-link"></a>
			        </div>
			    	<?php endforeach; ?>
			      </div>
			    </div>
			  </div>
			  <div class="accordion-item">
			    <h2 class="accordion-header" id="headingThree">
			      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			        <div class="h4 m-0">Пройти пізніше</div>
			        <div class="h5 text-dark my-0" style="position:absolute;right:50px;">
			        	<?php echo sizeof($favourite); ?>
			        </div>
			      </button>
			    </h2>
			    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
			      <div class="accordion-body">
			        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
			      </div>
			    </div>
			  </div>
			</div>
	    </div>
	    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">3</div>
	  </div>
	</div>
</div>
	<script>
	//оживление вкладок
	  var firstTabEl = document.querySelector('#myTab li:first-child button')
	  var firstTab = new bootstrap.Tab(firstTabEl);
	</script>
<!-- если пользователь неавторизован -->
<?php else : ?>
<div class="container col-lg-5 mx-auto">
	<div class="p-5 bg-light rounded">
			<div class="text-center">
			    <h2 class="mb-4">Вхід</h2>
			</div>
			<div class="container text-center mb-4">
			    <span>Немає аккаунту? <a href="/id/signup.php">Зареєструватися</a></span>
			</div>
			<form action="id/auth.php" method="post" class="needs-validation" novalidate>
			    <div class="mb-3">
			        <input type="email" class="form-control validate-me" id="login" name="login" value="<?php echo $login= isset($_GET['lgn']) ? $_GET['lgn'] : ''; ?>" placeholder="E-mail" required>
			        <div class="invalid-feedback" id="logmsg">
			            Введіть, будь-ласка, пошту
			        </div>
			    </div>
			            
			    <div class="mb-3">
			        <input type="password" class="form-control validate-me" id="password" name="password" placeholder="Пароль" value="" required>
			        <div class="invalid-feedback" id="passmsg">
			            Вкажіть пароль
			        </div>
			    </div>

			    <button class="btn btn-primary py-2 w-100" name="do_login" type="submit">Продовжити</button>
			</form>
			<div class="container text-center mt-3">
			    <span><a href="/id/recovery.php">Забули пароль?</a></span>
			</div>
		</div>
	</div>
<?php endif; ?>