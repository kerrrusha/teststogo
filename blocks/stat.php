<div class="container col-mg-7 p-3">
<div class="chartTab"> <!--Global Stats-->
	<h1>Глобальна статистика</h1>
	<table class="chart-table">
	<?php
		$percentageArray = array();
			
		$tests = R::getAll("SELECT id FROM test");

		echo '<tr>';
		foreach ($tests as $test) 
		{
			$testid = $test['id'];
			echo '
					<td>
					<div class="chart-back">
					<div class="chart-front" id="globalChart' . $testid .'">
				';

			$answers = R::getAll("SELECT SUM(answer.is_correct) as summa, COUNT(ticket_result.ticket_id) as answer_count 
							FROM ((answer_result INNER JOIN (ticket_result)
							ON (ticket_result.id = answer_result.ticket_result_id)) INNER JOIN answer
							ON answer_result.chosen_answer_id = answer.id) 
							WHERE ticket_result.ticket_id IN (SELECT id FROM ticket WHERE test_id = $testid)
							GROUP BY ticket_result.user_test_result_id");
			if($answers)
			{
				$percentageSum = 0;
				$iter = 0;
				foreach ($answers as $value) 
				{
					$percentageSum += $value['summa'] / $value['answer_count'] * 100;
					$iter++;
				}
				$percentage = $percentageSum / $iter;
				$formatedPercentage = number_format($percentage, 2);
				echo $formatedPercentage;
				echo '%';

				array_push($percentageArray, $formatedPercentage);
			}

			echo '			</div>
						</div>
					</td>';								
		}
		echo '</tr>';
		echo '<tr>';
		foreach ($tests as $test) 
		{
			$testid = $test['id'];
			$testname = R::getAll("SELECT name FROM test WHERE id = $testid");
			foreach ($testname as $testn)
				echo '<td>' . $testn['name'] . '</td>';
		}
		echo '</tr>';
		?>
					
		<script type="text/javascript">
			var percentageArray = [];
						
			<?php foreach ($percentageArray as $per) : ?>
				percentageArray.push(['<?php echo $per?>']);
			<?php endforeach; ?>

			for (i = 0; i < percentageArray.length; i++)
			{
				var chartblock = document.getElementById('globalChart' + (i+1));
				console.log(percentageArray[i]);
				chartblock.style.height = percentageArray[i]+'%';
			}
		</script>
	</table>
</div>

			<div class="chartTab"> <!--Self Stats-->
				<h1>Моя Статистика</h1>
				<table class="chart-table m-3">
					<?php
						if(isset($_COOKIE['logged_user_id']))
						{
							$userID = $_COOKIE['logged_user_id'];

							$percentageArray = array();
							$userTests = array();

							$tests = R::getAll("SELECT id FROM test");

							echo '<tr>';
							foreach ($tests as $test) 
							{
								$testid = $test['id'];

								$answers = R::getAll("SELECT SUM(answer.is_correct) as summa, COUNT(ticket_result.ticket_id) as answer_count 
								FROM ((answer_result INNER JOIN (ticket_result)
								ON (ticket_result.id = answer_result.ticket_result_id)) INNER JOIN answer
								ON answer_result.chosen_answer_id = answer.id) 
								WHERE ticket_result.ticket_id IN (SELECT id FROM ticket WHERE test_id = $testid)
								AND ticket_result.user_test_result_id in (SELECT id FROM user_test_result WHERE uid = $userID)");
								
								if($answers && $answers[0]['answer_count'] != '0')
								{
									echo '
									<td>
										<div class="chart-back">
											<div class="chart-front" id="selfChart' . $testid .'">
												AVG
												';
									
									$percentageSum = 0;
									$iter = 0;
									foreach ($answers as $value) 
									{
										$percentageSum += $value['summa'] / $value['answer_count'] * 100;
										$iter++;
									}
									$percentage = $percentageSum / $iter;
									$formatedPercentage = number_format($percentage, 2);
									
									echo $formatedPercentage;
									echo '%';
									
									echo '	</div>
										</div>
									</td>';

									array_push($percentageArray, $formatedPercentage);
									array_push($userTests, $testid);
								}
							}
							echo '</tr>';

							echo '<tr>';
							foreach ($userTests as $userTestID) 
							{
								$testname = R::getAll("SELECT name FROM test WHERE id = $userTestID");
								foreach ($testname as $testn)
								{
									echo '<td>' . $testn['name'] . '</td>';
								}
							}
							echo '</tr>';

							if (empty($userTests))
							{
								echo 'Ви ще не пройшли жодного тесту';
							}
						}
						else
						{
							echo 'Для перегляду особистого рейтингу - зареєструйтесь на сайті';
						}

					?>
					<script type="text/javascript">
						var percentageArray = [];
						var testIDArray = [];
						
						<?php foreach ($percentageArray as $per) : ?>
						percentageArray.push(['<?php echo $per?>']);
						<?php endforeach; ?>

						<?php foreach ($userTests as $testid) : ?>
							testIDArray.push(['<?php echo $testid?>']);
						<?php endforeach; ?>

						for (i = 0; i < percentageArray.length; i++)
						{
							var chartblock = document.getElementById('selfChart' + testIDArray[i]);
							chartblock.style.height = percentageArray[i]+'%';
						}
					</script>
				</table>
			</div>
</div>