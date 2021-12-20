<style type="text/css">
	th, td
	{font-weight: normal!important;}
</style>

<!-- если авторизован -->
<?php if(isset($_COOKIE['logged_user'])) : ?>
	<div class="container col-lg-9 mx-auto">
	<div class='my-3 d-flex flex-row justify-content-around align-items-center'>
		<h2 class="mb-4 display-4">Вітаю, <?php echo $_COOKIE['logged_user']; ?>.</h2>
		<span><a class="btn btn-outline-primary" href="/id/signout.php">Вийти</a></span>
	</div>
	<div class="d-flex align-items-start">
	  <div class="nav flex-column nav-pills me-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
	    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Профіль</button>
	    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Результати</button>
	    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Мої тести</button>
	  </div>
	  <div class="tab-content" id="v-pills-tabContent">
	    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
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
	    					<td>...</td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Пароль:</th>
	    					<td>...</td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Дата народження:</th>
	    					<td>...</td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Стать:</th>
	    					<td>...</td>
	    				</tr>
	    				<tr>
	    					<th scope=col style="border:0px;">
	    						</br><h4>Параметри пошти</h4>
	    					</th>
	    				</tr>
	    				<tr>
	    					<th scope="col">Пошта:</th>
	    					<td>...</td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Підтвердження електронної адреси:</th>
	    					<td>...</td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Отримувати корисні сповіщення:</th>
	    					<td>...</td>
	    				</tr>
	    				<tr>
	    					<th scope=col style="border:0px;">
	    						</br><h4>Активність</h4>
	    					</th>
	    				</tr>
	    				<tr>
	    					<th scope="col">Аккаунт створено:</th>
	    					<td>...</td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Тестів пройдено:</th>
	    					<td>...</td>
	    				</tr>
	    				<tr>
	    					<th scope="col">Час, проведений в тестуваннях:</th>
	    					<td>...</td>
	    				</tr>
	    			</tbody>
	    		</table>
	    	</div>
	    </div>
	    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">2</div>
	    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">3</div>
	  </div>
	</div>
</div>
	<script>
	  var firstTabEl = document.querySelector('#myTab li:first-child button')
	  var firstTab = new bootstrap.Tab(firstTabEl);
	</script>
	
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