<style type="text/css">
	/* For Mobile */
	@media screen and (max-width: 540px) 
	{
    	* {font-size:0.8rem;}
    }
}
</style>

<?php 
	$uid = isset($_COOKIE['logged_user_id']) ? $_COOKIE['logged_user_id'] : null;
?>

<div class="container col-mg-7 p-3">
		<!-- Комментарий -->
    <div class="p-3 mb-4 bg-light rounded-3">
      <div class="container-fluid pb-5 mb-3 mx-3">
        <h1 class="display-5 fw-bold">Створюйте свої тести</h1>
        <p class="col-md-8 fs-4">На нашому сайті ви маєте можливість створювати, налаштовувати, ділитись та отримувати інформацію щодо проходжень ваших тестів.</p>
        <?php if($uid): ?>
        <form method='post' action='wizard/create.php'> 
        	<button class="btn btn-primary btn-lg" type="submit" name='start'>Розпочати</button>
        </form>
        <?php else: ?>
        <button onclick="open_main_tab(3)" class="btn btn-primary btn-lg" type="button">Авторизуйтесь</button>
    	<?php endif; ?>
      </div>
      <h1 class="display-5 text-center mb-5">Ми розрізняємо два типи тестувань:</h1>
      <div class="row align-items-md-stretch">
	      <div class="col-md-6">
	        <div class="h-100 p-5 text-white bg-dark rounded-3 d-flex flex-column justify-content-between">
	          <h2>Технічний</h2>
	          <p>Тест формату "правильно-неправильно" з гнучкими налаштуваннями.</br> 
	          Існує два режими:</br> 
	          <strong>звичайний</strong> - за проходження можна отримати Рейтингові бали; їх кількість визначається адміністрацією сайту</br>
	      	  <strong>екзаменаційний</strong> - робота на оцінку; автор може переглядати проходження його тесту іншими учасниками; ви особисто визначаєте бали (оцінку) для кожного питання.</p>
	          <?php if($uid): ?>
	          <form method='post' action='wizard/create.php'>
		       	<input type="hidden" name="test_type" value='0'>
		       	<button class="btn btn-outline-light" type="submit" name='start'>Створити технічний</button>
		      </form>
		      <?php else: ?>
		      	<button class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Зареєструйтесь, будь-ласка, на сайті" type="button">Створити технічний</button>
		      <?php endif; ?>
	        </div>
	      </div>
	      <div class="col-md-6">
	        <div class="h-100 p-5 bg-white border rounded-3 d-flex flex-column justify-content-between">
	          <h2>Абстрактний</h2>
	          <p>Тест формату "дізнайся свій психотип" або "хто ти із серіалу" з унікальними методами оцінювання.</br>
	          У питань немає правильної відповіді, а результати можна дізнатися лише після виконання тесту.</br>
	          Автор не бачитиме проходження його тестів, за виконання можна отримати лише Рейтингові бали.</br>
	          Для кожного тесту створюється персональний метод оцінювання.
	          </p>
	          <?php if($uid): ?>
	          <form method='post' action='wizard/create.php'>
		       	<input type="hidden" name="test_type" value='1'>
		       	<button class="btn btn-outline-secondary" type="submit" name='start'>Створити абстрактний</button>
		      </form>
		      <?php else: ?>
		      	<button class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="Зареєструйтесь, будь-ласка, на сайті" type="button">Створити абстрактний</button>
		      <?php endif; ?>
	        </div>
	      </div>
       </div>
    </div>
</div>

<script type="text/javascript">
	//запуск bootstrap tooltips на кнопки 
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	})

	//открыть вкладку главной навпанели
	function open_main_tab(index)
	{
	  //скрываем все tooltips
	  const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
	  tooltips.forEach((tooltip) => {
	    const instance = bootstrap.Tooltip.getInstance(tooltip);
	    instance.hide();
	  })

	  window.open('#tab-3','_self');
	  $('#tabs .tabs-nav a').eq(index - 1).click();
	}
</script>