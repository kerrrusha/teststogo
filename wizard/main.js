class Config
{
  constructor()
  {
    this.show_answers = true;
    this.tickets_shuffle = false;
    this.for_authorised_users_only = false;
    this.testing_for_exam_points = false;
    this.time_constraint_is_active = false;
    this.time_constraint_in_seconds = 0;
  }
}

class Answer
{
  constructor()
  {
    this.answer = "";
    this.is_correct = false;
  }
}

class Ticket
{
  constructor()
  {
    this.question = "";
    this.ticket_type = "";
    this.answers = [];
  }
}

class Technical_Test
{
  constructor() 
  {
    this.name = "";
    this.description = "";
    this.category = "";
    this.logo = null; 
    this.config = new Config();
    this.tickets = [];
  }

  clear()
  {
    this.name = "";
    this.description = "";
    this.category = "";
    this.logo = null; 
    this.config = new Config();
    this.tickets = [];
  }

  collect_data()
  {
    this.clear();

    this.name = document.getElementById('name').value;
    this.description = document.getElementById('description').value;
    this.category = $("#category option:selected").text();
    this.logo = document.getElementById("fileToUpload").files;

    this.config.show_answers = document.getElementById('show_answers').checked;
    this.config.tickets_shuffle = document.getElementById('tickets_shuffle').checked;
    this.config.for_authorised_users_only = document.getElementById('for_authorised_users_only').checked;
    this.config.testing_for_exam_points = document.getElementById('testing_for_exam_points').checked;
    this.config.time_constraint_is_active = document.getElementById('time_constraint_is_active').checked;
    this.config.time_constraint_in_seconds = this.config.time_constraint_is_active ? 60 * get_minutes(document.getElementById('time_constraint_in_seconds').value) : 0;

    var ticketbox = document.getElementById('ticketbox');
    //заполнение вопросов
    for (var i = 0; i < ticketbox.children.length; i++) 
    {
      var ticket = new Ticket();

      ticket.question = document.getElementById('question'+(i+1).toString()).value;
      ticket.ticket_type = $("#ticket_type"+(i+1).toString()+" option:selected").text();
      
      //заполнение ответов
      var answerbox = document.getElementById('answerbox_ticket'+(i+1).toString());
      for(var j = 0; j < answerbox.children.length; j++)
      {
        var answer = new Answer();
        
        answer.answer = document.getElementById('ticket'+(i+1).toString()+'_answer'+(j+1).toString()).value;
        answer.is_correct = document.getElementById('ticket'+(i+1).toString()+'_answer'+(j+1).toString()+'_iscorrect').checked;

        ticket.answers.push(answer);
      }

      this.tickets.push(ticket);
    }
  }
}

var test = new Technical_Test;

var fileToUpload = document.getElementById('fileToUpload');
if(fileToUpload)
  fileToUpload.onchange = evt => {
  var imageInput = document.getElementById("fileToUpload");
  var imagePreview = document.getElementById("img_preview");

  const [file] = imageInput.files;
  if (file) 
    imagePreview.src = URL.createObjectURL(file);

  //включаем кнопку удаления лого
  document.getElementById("delete_logo").disabled = false;
}

function upload_logo()
  {
        var property = document.getElementById('fileToUpload').files[0];

        //если файл не указан
        if(property == null)
        {
          document.getElementById('msg').innerHTML = "Оберіть, будь-ласка, зображення";
          return false;
        } 

        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        
        //если указан недопустимый тип файла
        if(jQuery.inArray(image_extension,['png','jpg','jpeg','']) == -1)
        {
          document.getElementById('msg').innerHTML = "Некоректний формат файлу. Оберіть, будь-ласка, інший";
          return false;
        }
        if(property.size > 1 * 1024 * 1024)
        {
          document.getElementById('msg').innerHTML = "Розмір зображення не має перевищувати 1 МБ";
          return false;
        }
        document.getElementById('msg').innerHTML = "";        

        var form_data = new FormData();
        form_data.append("file",property);
        $.ajax({
          url:'img_upload.php',
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function()
          {
            //$('#msg').html('Loading......');
          },
          success:function(data)
          {
            if(data.substr(1,3) == 'img')
              $('#img_preview_div').html(data);
            else
               $('#msg').html(data);
          }
        });

        //включаем кнопку удаления лого
        document.getElementById("delete_logo").disabled = false;
  }
  function reverseString(str) 
  {
    return str.split("").reverse().join("");
  }
  function reset_logo()
  {
    $('#img_preview_div').html('<img id="img_preview" src="../images/png/test_icon_default.png" class="rounded-circle" height="150" width="150">');
    document.getElementById('fileToUpload').value = "";

    //выключаем кнопку удаления лого
    document.getElementById("delete_logo").disabled = true;
  }
  function delete_logo()
  {
    var fakepath = document.getElementById('fileToUpload').value;
    var filename = '';
    //извлекаем из пути название файла
    for (var i = fakepath.length - 1; i >= 0; i--) 
    {
      if(fakepath[i] == '/' || fakepath[i] == "\\")
        break;
      filename += fakepath[i];
    }
    filename = reverseString(filename);

    $.ajax({
        type: 'POST',
        url: 'img_delete.php',
        data: { 'filename' : filename },
        success: function(data) 
        {
            $('#img_preview_div').html('<img id="img_preview" src="../images/png/test_icon_default.png" class="rounded-circle" height="150" width="150">');
        }
    });

    //выключаем кнопку удаления лого
    document.getElementById("delete_logo").disabled = true;
  }

function get_minutes(val)
{
  var min = null;

  if(val <= 20)
    min = val;
  else if(21 <= val && val <= 28)
    min = 20 + (val - 20) * 5;
  else if(29 <= val && val <= 34)
    min = 60 + (val - 28) * 10;
  else if(35 <= val && val <= 38)
    min = 120 + (val - 34) * 15;
  else if(39 <= val && val <= 41)
    min = 180 + (val - 38) * 20;
  else if(42 <= val && val <= 43)
    min = 240 + (val - 41) * 30;

  return min;

  /*
  val - min
  1 1
  2 2
  3 3 
  ...
  20 20
  21 25
  22 30
  ...
  28 60
  29 1 10
  30 1 20
  31 1 30
  32 1 40
  33 1 50
  34 2 
  35 2 15
  36 2 30
  37 2 45
  38 3
  39 3 20
  40 3 40
  41 4
  42 4 30
  43 5
  */
}

function get_time(val)
{
  var minutes = get_minutes(val);
  var hrs = parseInt(minutes / 60);

  if(hrs == 0)
    return (minutes + ' хв');

  var min = (minutes % (60*hrs));
  if(min == 0)
    return (hrs + ' год');
  return (hrs + ' год ' + min + ' хв');
}

//обработка чекбокса ограничения по времени
$("#time_constraint_is_active").change(function() 
{
    if(this.checked) 
    {
      var range = "<label for='time_constraint_in_seconds' id='slider_info' class='form-label'>1 хв.</label>";
      range += "<input type='range' class='form-range' min='1' max='43' value='25' id='time_constraint_in_seconds'>";

      $("#time_constraint_in_seconds_div").html(range);
      
      //показание начальных значений слайдера
      var val = document.getElementById("time_constraint_in_seconds").value;
      $("#slider_info").html(get_time(val));

      //установка обработчика слайдера времени
      $("#time_constraint_in_seconds").on("input change", function() 
      {
          var val = document.getElementById("time_constraint_in_seconds").value;
          $("#slider_info").html(get_time(val));
      });
    }
    else
    {
      $("#time_constraint_in_seconds_div").html("");
    }
});

function new_question()
{
  var ticketbox = document.getElementById('ticketbox');
  var question_amount = ticketbox.children.length;

  var ticket_type_options = [];
  var options = document.getElementById('ticket_types').children;
  for (var i = 0; i < options.length; i++) 
    ticket_type_options.push('<option value="'+(i+1).toString()+'">'+options[i].innerHTML+'</option>');

  elem = '<div class="card py-2 px-5 mb-2 border-dark">';
  elem += '<div style="position: absolute; right: 10px;">';
  elem += '<button type="button" class="btn-close" aria-label="Close" onclick="remove_question('+(question_amount+1).toString()+')"></button>';
  elem += '</div>';
  elem += '<div class="row mb-3">';
  elem += '<div class="col-9">';
  elem += '<label for="question1">Питання #'+(question_amount+1).toString()+'</label>';
  elem += '<textarea class="form-control" id="question'+(question_amount+1).toString()+'" rows="2"></textarea>';
  elem += '</div>';
  elem += '<div class="col-3">';
  elem += '<label for="ticket_type'+(question_amount+1).toString()+'">Тип</label>';
  elem += '<select class="form-select" id="ticket_type'+(question_amount+1).toString()+'" name="ticket_type'+(question_amount+1).toString()+'" onchange="type_change('+(question_amount+1).toString()+')">';
  elem += ticket_type_options;
  elem += '</select>';
  elem += '</div>';
  elem += '</div>';
  elem += '<hr>';
  elem += '<div id="answerbox_ticket'+(question_amount+1).toString()+'">';
  elem += '<div class="mb-3">';
  elem += '<div class="d-flex flex-row justify-content-between">';
  elem += '<div>';
  elem += '<input type="radio" id="ticket'+(question_amount+1).toString()+'_answer1_iscorrect"';
  elem += 'name="ticket'+(question_amount+1).toString()+'" value="1">';
  elem += '<label for="ticket'+(question_amount+1).toString()+'_answer1_iscorrect">Відповідь #1</label>';
  elem += '</div>';
  elem += '<button type="button" class="btn-close" aria-label="Close" style="display: none;" onclick="remove_answer('+(question_amount+1).toString()+', 1)"></button>';
  elem += '</div>'
  elem += '<input type="text" class="form-control validate-me" id="ticket'+(question_amount+1).toString()+'_answer1" name="ticket'+(question_amount+1).toString()+'_answer1" placeholder="" value="" required>';
  elem += '</div>';
  elem += '<div class="mb-3">';
  elem += '<div class="d-flex flex-row justify-content-between">';
  elem += '<div>';
  elem += '<input type="radio" id="ticket'+(question_amount+1).toString()+'_answer2_iscorrect"';
  elem += 'name="ticket'+(question_amount+1).toString()+'" value="1">';
  elem += '<label for="ticket'+(question_amount+1).toString()+'_answer2_iscorrect">Відповідь #2</label>';
  elem += '</div>';
  elem += '<button type="button" class="btn-close" aria-label="Close" style="display: none;" onclick="remove_answer('+(question_amount+1).toString()+', 2)"></button>';
  elem += '</div>'
  elem += '<input type="text" class="form-control validate-me" id="ticket'+(question_amount+1).toString()+'_answer2" name="ticket'+(question_amount+1).toString()+'_answer2" placeholder="" value="" required>';
  elem += '</div>';
  elem += '</div>';
  elem += '<button class="btn btn-outline-secondary w-100 p-2 mb-3" onclick="new_answer('+(question_amount+1).toString()+')">';
  elem += '<div class="mx-auto">';
  elem += '<svg class="bi flex-shrink-0 me-2" width="36" height="36" role="img" aria-label="Info:"><use xlink:href="#plus-circle"/></svg>';
  elem += 'Додати відповідь';
  elem += '</div>';
  elem += '</button>';
  elem += '</div>';

  ticketbox.insertAdjacentHTML('beforeend', elem);

  //проверяем если вопросов больше чем 1 (мин. к-ство), то добавляем кнопки удаления вопросов
  if(ticketbox.children.length > 1)
    for (var i = 0; i < ticketbox.children.length; i++) 
    {
      ticketbox.children[i].children[0].style.display = 'initial';
    }
}
function new_answer(question_number)
{
  var answerbox = document.getElementById('answerbox_ticket'+question_number.toString());
  var answer_amount = answerbox.children.length;

  var ticket_num = 'ticket'+question_number.toString();
  var answer_num = 'answer'+(answer_amount + 1).toString();

  elem = '<div class="mb-3">';
  elem += '<div class="d-flex flex-row justify-content-between">';
  elem += '<div>';
  elem += '<input type="radio" id="'+ticket_num+'_'+answer_num+'_iscorrect"';
  elem += 'name="'+ticket_num+'" value="1">';
  elem += '<label for="'+ticket_num+'_'+answer_num+'_iscorrect">&nbspВідповідь #'+(answer_amount + 1).toString()+'</label>';
  elem += '</div>';
  elem += '<button type="button" class="btn-close" aria-label="Close" style="display: none;" onclick="remove_answer('+question_number.toString()+', '+(answer_amount + 1).toString()+')"></button>';
  elem += '</div>'
  elem += '<input type="text" class="form-control validate-me" id="'+ticket_num+'_'+answer_num+'" name="'+ticket_num+'_'+answer_num+'" placeholder="" value="" required>';
  elem += '</div>';

  answerbox.insertAdjacentHTML('beforeend', elem);

  //проверяем если ответов больше 2 шт. (мин. к-ство), то добавляем кнопки удаления ответов
  if(answerbox.children.length > 2)
    for (var i = 0; i < answerbox.children.length; i++) 
    {
      answerbox.children[i].children[0].children[1].style.display = 'initial';
    }
}
function remove_question(question_number)
{
  document.getElementById('ticketbox').children[question_number-1].remove();

  //проставляем правильную нумерацию вопросов
  for (var i = 0; i < document.getElementById('ticketbox').children.length; i++) {
    document.getElementById('ticketbox').children[i].children[1].children[0].children[0].innerHTML = 'Питання #' + (i+1).toString();
  }

  //проверяем если вопросов 1 шт. (мин. к-ство), то убираем кнопки удаления вопросов
  if(ticketbox.children.length == 1)
    for (var i = 0; i < ticketbox.children.length; i++) 
    {
      ticketbox.children[i].children[0].style.display = 'none';
    }
}
function remove_answer(question_number, answer_number)
{
  var answerbox = document.getElementById('answerbox_ticket'+question_number.toString());
  answerbox.children[answer_number-1].remove();

  //проставляем правильную нумерацию ответов
  for (var i = 0; i < answerbox.children.length; i++) {
    answerbox.children[i].children[0].children[0].children[1].innerHTML = 'Відповідь #' + (i+1).toString();
  }

  //проверяем если ответов 2 шт. (мин. к-ство), то убираем кнопки удаления ответов
  if(answerbox.children.length == 2)
    for (var i = 0; i < answerbox.children.length; i++) 
    {
      answerbox.children[i].children[0].children[1].style.display = 'none';
    }
}
function type_change(question_number)
{
  var type_id = document.getElementById('ticket_type'+question_number.toString()).value;
  var answerbox = document.getElementById('answerbox_ticket'+question_number.toString());

  var type = null;
  if(type_id == 1)
    type = "radio";
  else
    type = "checkbox";

  for(var i = 0; i < answerbox.children.length; i++)
  {
    answerbox.children[i].children[0].children[0].children[0].type = type;
  }
}
function go_back(current_tab)
{
  tabs = [$("#start-tab"), $("#info-tab"), $("#setup-tab"), $("#create-tab"), $("#finish-tab")];
  tabs[current_tab - 2].tab('show');
}
function go_forward(current_tab)
{
  tabs = [$("#start-tab"), $("#info-tab"), $("#setup-tab"), $("#create-tab"), $("#finish-tab")];
  tabs[current_tab].tab('show');
}

function errorbox_clear()
{
  var errorbox = document.getElementById('error-box'),
      errorbox_childrens = errorbox.children.length;
      for (var i = 0; i < errorbox_childrens; i++) 
        errorbox.children[0].remove();
}
function previewbox_clear()
{
  var previewbox = document.getElementById('preview-box'),
      previewbox_childrens = previewbox.children.length;
  for(var i = 0; i < previewbox_childrens; i++)
    previewbox.children[0].remove();
}

// обработка события show.bs.tab (для загрузки предпросмотра теста, ошибок и тд)
$('[data-bs-toggle="tab"]').on('show.bs.tab', function (e) {
  //если открываем вкладку с предпросмотром
  if($(e.target).attr('id') == 'finish-tab')
  {
    var errors = [];

    if(document.getElementById('name').value.length < 3)
    {
      var js = "$('#info-tab').tab('show')";
      errors.push('<li><a style="cursor:pointer;text-decoration: underline;" onclick="'+js+'">Не вказано <strong>назву</strong></a> <small>(мін. 3 символи)</small></li>');
    }

    //проверка заполнения вопросов
    var ticketbox = document.getElementById('ticketbox');
    for (var i = 0; i < ticketbox.children.length; i++) 
    {
      if(document.getElementById('question'+(i+1).toString()).value.length < 3)
      {
        var js = "$('#create-tab').tab('show')";
        errors.push('<li><a style="cursor:pointer;text-decoration: underline;" onclick="'+js+'">Не введено питання <strong>#'+(i+1).toString()+'</strong></a> <small>(мін. 3 символи)</small></li>');
      }
    }

    //проверка заполнения ответов
    var ticketbox = document.getElementById('ticketbox');
    for (var i = 0; i < ticketbox.children.length; i++) 
    {
      var answerbox = document.getElementById('answerbox_ticket' + (i+1).toString());
      for(var j = 0; j < answerbox.children.length; j++)
      {
        if(document.getElementById('ticket'+(i+1).toString()+'_answer'+(j+1).toString()).value.length < 1)
        {
          var js = "$('#create-tab').tab('show')";
          errors.push('<li><a style="cursor:pointer;text-decoration: underline;" onclick="'+js+'">Порожня відповідь <strong>#'+(j+1).toString()+'</strong> до питання <strong>#'+(i+1).toString()+'</strong></a></li>');
        }
      }
    }

    //если есть ошибки
    if(errors.length > 0)
    {
      //очищаем блок ошибок
      errorbox_clear();
      //очищаем блок предпросмотра
      previewbox_clear()

      //блокаем кнопку публикации
      document.getElementById('publicate').disabled = true;

      var elem = "";

      elem += '<div class="alert alert-danger d-flex flex-column align-items-start" role="alert">';
      elem += '<svg class="bi flex-shrink-0 me-2" style="position: absolute; left:20px;" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>';
      elem += '<div class="mb-3 mx-auto">';
      elem += '<strong>Здається, щось не так:</strong>';
      elem += '</div>';
      elem += '<ul class="m-0">';
      
      for(var i=0; i<errors.length; i++)
        elem += errors[i];

      elem += '</ul>';
      elem += '</div>';
        
      document.getElementById('error-box').insertAdjacentHTML('beforeend', elem);
    }
    else
    {
      //очищаем блок ошибок
      errorbox_clear();
      //очищаем блок предпросмотра
      previewbox_clear()

      //создаем обновленный предпросмотр
      var elem = '';
      elem += '<h1 class="display-5 fw-bold">Попередній перегляд</h1>';
      elem += '<iframe class="w-100" src="test_preview.html" id="preview-frame" style="height:60vh;"></iframe>';
      document.getElementById('preview-box').insertAdjacentHTML('beforeend', elem);

      //заполняем его
      var iframe = document.getElementById('preview-frame');
      iframe.onload = function () {
        //получаем доступ к документу
        var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;

        //собираем введённые данные по всей странице
        test.collect_data();
        console.log(test);

        iframeDocument.getElementById('test_preview_name').innerHTML = test.name;
        //выводим вопросы
        var test_preview_box = iframeDocument.getElementById('test_preview_box');
        var elem = '';
        for (var i = 0; i < test.tickets.length; i++) {
          elem += '<div id="test_preview_ticket'+(i+1).toString()+'">';
          elem += '<p class="roboto font-weight-500 mt-3 mb-2 text-center">'+(i+1).toString()+'. '+test.tickets[i].question+'</p>';
          
          //добавляем ответы
          for (var j = 0; j < test.tickets[i].answers.length; j++) {
            elem += '<div class="box my-0">';
            elem += '<input ';
            elem += 'type="radio" ';
            elem += 'name="ticket'+(i+1).toString()+'" ';
            elem += 'id="ticket'+(i+1).toString()+'_answer'+(j+1).toString()+'" ';
            elem += 'disabled ';
            elem += '>';
            elem += '<label class="row flex-nowrap justify-content-between" for="ticket'+(i+1).toString()+'_answer'+(j+1).toString()+'">';
            elem += test.tickets[i].answers[j].answer;
            if(test.tickets[i].answers[j].is_correct)
            {
              elem += '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">';
              elem += '<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">';
              elem += '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>';
              elem += '</symbol>';
              elem += '</svg>';
              elem += '<svg style="color:green;width:initial;" class="bi" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>';
            }
            elem += '</label>';
            elem += '</div>';
          }
          
          elem += '</div>';
        }
        test_preview_box.insertAdjacentHTML('beforeend', elem);
      }

      //разблокировуем кнопку публикации
      document.getElementById('publicate').disabled = false;
    }
  }
});