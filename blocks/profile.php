<?php if(isset($_COOKIE['logged_user'])) : ?>
				<div class="container col-lg-5 mx-auto">
					<h2 class="mb-4">Вітаю, <?php echo $_COOKIE['logged_user']; ?>.</h2>
					<span><a href="/id/signout.php">Вийти</a></span>
				</div>
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