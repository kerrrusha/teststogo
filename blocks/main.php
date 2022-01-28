<div class="container col-lg-9 mx-auto">
				    <div class="p-5 bg-light rounded">
					    <div class="text-start mb-3">
					    	<h2>Тести онлайн</h2>
					    </div>
					    <div class="text-muted mb-4">
					    	<span>
					    		<?php 
					    			$test_categories = R::getAll("select * from test_category");

					    			for($i = 0; $i < sizeof($test_categories); $i++)
					    			{
					    				$sep = ", ";
					    				if($i == sizeof($test_categories) - 1)
					    					$sep = "";
					    				echo mb_convert_case($test_categories[$i]['plural'], MB_CASE_TITLE, "UTF-8") . $sep;
					    			}
					    		 ?>
					    	</span>
					    </div>

					    <div class="row">
					    <?php 
					    	$tests = R::getAll("select id, name, description, author_id, creating_date from test");

							//если тесты есть
							if($tests)
					    	{
					    		foreach ($tests as $value) 
					    		{
					    			echo '
					    				<div class="col-md-6">
								        	<div class="test_preview">
					                        <a href="/tests/quiz.php?id=' . $value['id'] . '">
					                            <section>
					                            	<article class="mx-3">
					                                	<img src="/images/png/test_icon_default.png" width=50px title="Розпочати тестування">
					                                </article>
					                                <article class="mx-2">
					                                    ' . $value['name'] . '
					                                </article>
					                            </section>
					                        </a>
					                    	</div>
				                    	</div>
					    			';
					    		}
					    	}
					    	else
					    	{
					    	    echo 'Нажаль, в даний момент список тестів недоступний';
					    	}
					    ?>
					    </div>

				    </div>
				</div>