<script>          
          var currentTab = 0; // Current tab is set to be the first tab (0)
          
          showTab(currentTab); // Display the current tab

          function moveTo(btn)
          {
            to = btn.id.replace('step', '');
            nextPrev(to-currentTab);
          }

          //отправка данных на сервер через ajax запрос
          function callPHP(params) 
          {
              $.ajax({
                        url: 'send_results_to_db.php',
                        type: 'POST',
                        data: params,
                        success: function(response) 
                        {
                            console.log(response);
                        },
                        cache:false               
                    });
          }

          window.onload = function() 
          {
            //если была подгружена история ответов, вопросы на которые есть ответы рисуем зеленым

            var x, y, i;
            x = document.getElementsByClassName("tab");

            // итерируемся по всем вопросам
            for (var j = 0; j < x.length; j++) 
            {
              y = x[j].getElementsByTagName("input");
              
              // итерируемся по всем ответам
              for (i = 0; i < y.length; i++) 
              {
                // если есть хоть один отмеченный вопрос
                if (y[i].checked == 1) 
                {
                  // отмечаем зеленым
                  document.getElementsByClassName("step")[j].className += " finish";
                  break;
                }
            } 
            }
          };

          function changeNextBtnName(name, on_last_page, ticket_id, answer_id, test_id, user_id)
          {
            var btn = document.getElementById("nextBtn");
            btn.classList.remove("btn-outline-primary");
            btn.classList.add("btn-primary");
              
            if(!on_last_page)
            {
              btn.innerHTML = name;
            }

            //отмечаем тест зеленым, т.к. указали ответ
            validateRadioForm();

            //просим php добавить выбранный ответ в бд (если пользователь авторизован)
            if(user_id != -1)
            {
              params = {
                              current_ticket_id: ticket_id,
                              current_answer_id: answer_id,
                              test_id: test_id,
                              uid: user_id
                        };
              console.log(params);
              callPHP(params);
            }
          }

          function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            document.getElementById('curTab').innerHTML = (n+1).toString()+'/'+<?php echo $test->tickets_amount?>;
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
              document.getElementById("prevBtn").style.display = "none";
            } else {
              document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) 
            {
              document.getElementById("nextBtn").innerHTML = "Завершити тестування";
            } 
            else 
            {
              if(!picked())
              {
                document.getElementById("nextBtn").classList.add("btn-outline-primary");
                document.getElementById("nextBtn").classList.remove("btn-primary");
                document.getElementById("nextBtn").innerHTML = "Пропустити";
              }
              else
              {
                document.getElementById("nextBtn").classList.remove("btn-outline-primary");
                document.getElementById("nextBtn").classList.add("btn-primary");
                document.getElementById("nextBtn").innerHTML = "Далі";
              }
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n)
          }

          function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateRadioForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
              //...the form gets submitted:
              document.getElementById("testingForm").submit();
              return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
          }

          function validateRadioForm() 
          {
            /*// эта функция проверяет валидность чекбокс-форм
            var x, y, i, valid = false;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
                  
            // если хоть один вариант выбран, валидация пройдена
            for (i = 0; i < y.length; i++) 
            {
              // если галочка стоит
              if (y[i].checked == 1) 
              {
                // все ок, валидируем, идем на след форму
                document.getElementsByClassName("step")[currentTab].className += " finish";
                valid = true;
                break;
              }
            }
            //если ни одного варианта не было выбрано
            if(!valid)
            {
              //помечаем все чекбоксы как инвалидные
              for (i = 0; i < y.length; i++) 
              {
                y[i].className += " invalid";
              }
            }      
            
            return valid; // return the valid status*/

            //отмечание кружков прогресса зеленым
            var x, y, i;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");

            // если хоть один вариант выбран, валидация пройдена
            for (i = 0; i < y.length; i++) 
            {
              // если галочка стоит
              if (y[i].checked == 1) 
              {
                // все ок, валидируем, идем на след форму
                document.getElementsByClassName("step")[currentTab].className += " finish";
                break;
              }
            }

            return 1;
          }

          function picked()
          {
            //данная функция вернет 1, если выбран хотя бы один чекбокс
            var x, y, i, valid = false;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
                  
            // если хоть один вариант выбран, валидация пройдена
            for (i = 0; i < y.length; i++) 
            {
              // если галочка стоит
              if (y[i].checked == 1) 
              {
                valid = true;
                break;
              }
            }

            return valid; // return the valid status*/
          }

          function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
              x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
          }
</script>