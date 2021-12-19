<?php 
	require_once "libs/rb.php";           //подключение библиотеки RedBean PHP
    require_once "blocks/db.php"; 
    require "tests/class_description.php";

	//количество лучших игроков на вывод в таблицу
	$top = 10;

	//сбор статистики всех пользователей по сайту
	$topstats = R::getAll("select uid, sum(score_points) as score, count(*) as count from `user_test_result` group by uid order by score desc limit ?", [$top]);

	//максимально возможное к-ство рейтинга
	$maxscore = R::getRow("select sum(reward_score_points) as sum from `ticket`")['sum'];

	//количество всех тестов ( считая нерейтинговых)
	$open_tests_count = R::getRow("select count(*) as count from `test` where 1")['count'];

	//цвета рейтинга (соответствие цвета к проценту набранного рейтинга от макс. возможного) (фиол/син/зел/жел/оранж)
	$rating_color = array(
		'#d042f3' => 0.95,
		'#02c9b3' => 0.85,
		'#60ff00' => 0.75,
		'#f8f403' => 0.65,
		'#fe7903' => 0.6,
	);
?>

<style type="text/css">
	td{font-weight: bold;}
</style>

<div class="container col-mg-7 p-3">
  <div class=""> <!--Global rating-->
  	<h1 class="display-4">Глобальний рейтинг</h1>
  	<small class="text-muted h4 p-1">ТОП-10 ПО САЙТУ</small>
	<table class="table table-striped mt-3" style="table-layout: fixed;">
	  <thead class="border border-dark">
	    <tr>
	      <th scope="col">Місце</th>
	      <th scope="col">Користувач</th>
	      <th scope="col">Рейтинг</th>
	      <th scope="col">Пройдено тестів</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php 
	  	$i = 0;
	  	foreach ($topstats as $row) 
	  	{
	  		$username = R::getRow("select username from `user` where id=?", [$row['uid']])['username'];
	  		$rating = $row['score'];
	  		$count = $row['count'];		//к-ство пройденных тестов

	  		//процент полученного рейтинга по сравнению с максимально допустимым
	  		$current_to_max_rating = $rating / $maxscore;

	  		//процент пройденных тестов по сравнению с максимально допустимым
	  		$current_to_max_count = $count / $open_tests_count;

	  		echo '
	  		<tr ';

	  		//окрашивание топ-3 мест
	  		if($i == 0) 
				echo 'style="background: #FFD700;" class="bg-gradient"';
	  		if($i == 1)
	  			echo 'style="background: #c0c0c0;" class="bg-gradient"';
	  		if($i == 2)
	  			echo 'style="background: #b87333;" class="bg-gradient"';

	  		echo '>
		      <th scope="row">'. ($i + 1) .'</th>
		      <td>@'. $username .'</td>
		      <td ';

		    //окрашивание рейтинга
		    foreach ($rating_color as $color => $coef) 
		    	if($current_to_max_rating >= $coef)
		    	{
		    		echo 'style="color:'. $color .';"';
		    		break;
		    	}

		    echo '>'. $rating .'</td>
		      <td ';

		    //окрашивание к-ства пройденных тестов от максимально возможных
		    foreach ($rating_color as $color => $coef) 
		    	if($current_to_max_count >= $coef)
		    	{
		    		echo 'style="color:'. $color .';"';
		    		break;
		    	}

		    echo '>'. $count .'</td>
		    </tr>
	  		';

	  		$i += 1;
	  	}
	  	?>
	  </tbody>
	</table>
  </div>
</div>