<? 
require_once("../inc/db_func.php");
require_once("../inc/config.php");
if(isset($_SESSION["idUser"]))
          {$idid = $_SESSION["idUser"];}
        else{
          $idid = 0;
        }
$keyf = 1;
$kon=getKonAd($keyf);
?>
<!DOCTYPE html>
<html>
<?
   require_once("head.php");
?>
<body>
    <header>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://online.ru/">Online.ru</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="http://online.ru/">Результат голосования</a></li>
      <?
        if(isset($_SESSION["idUser"]))
        {
          echo "<li><a href='spisok.php'>Список конкурсантов</a></li>";
        }
        if($_SESSION["idUser"] == 1)
            {
              echo "<li  class='active'><a href='panel.php'>Работа с конкурсантами</a></li>";
            }
      ?>
      <li><a href="about.php">О системе</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?
        if(isset($_SESSION["idUser"]))
        {
          echo "<li><a href='' id='logout'>Выход</a></li>";
        }
        else{
          echo "<li><a data-toggle='modal' href='javascript:void(0)' onclick='openRegisterModal();'> Зарегистрироваться</a></li>";
          echo "<li><a data-toggle='modal' href='javascript:void(0)' onclick='openLoginModal();'> Авторизоваться</a></li>";
        }
      ?>
    </ul>
  </div>
</nav>
</header>
<div class="wrapper">

  <div class="content">
<center><h1>Работа с конкурсантами</h1>
<div style="width: 90%;" class="fil" id="add">Добавить конкурсанта</div></center>
<div id="konn">
<?
    foreach($kon as $card)
     {

      if (file_exists("uploads/".$card["id"].".jpg")) {
        $photo = $card["id"];
      }
      else{
        $photo = 0;
      }

      echo <<<NITEM

      <div class="card">
      <div class="photo"><img src="uploads/{$card["id"]}.jpg"></div>
      <div class="txt">
        <div class="name" value="{$card["name"]}">{$card["name"]}</div>
        <div class="disc">{$card["text"]}</div>
        <div class="data">Дата регистрации: {$card["oth"]} Количество голосов: <b>{$card["kolgol"]}</b></div>
      </div>
      <div class="red" id="{$card["id"]}">Редактировать</div>
      <div class="del" id="{$card["id"]}">Удалить</div>
    </div>

NITEM;
      $posi = $posi + 1;
     }

    ?>
</div>
  </div>

<div class="footer">
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="http://www.volpi.ru/" target="_blank"> Разработано в ВПИ</a> Иванов В.
  </div>
<div class="modal fade login" id="loginModal">
  <div class="modal-dialog login animated">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Авторизация</h4>
      </div>
      <div class="modal-body"> 
        <div class="box">
          <div class="content">
            <div class="error"></div>
            <div class="form loginBox">
              <form method="" action="" accept-charset="UTF-8">
                <input id="email" class="form-control" type="text" placeholder="Email" name="email" required="required">
                <input id="password" class="form-control" type="password" placeholder="Пароль" name="password" required="required">
                <input class="btn btn-default btn-login" type="button" value="Авторизоваться" onclick="loginAjax()">
              </form>
            </div>
          </div>
        </div>
        <div class="box">
          <div class="content registerBox" style="display:none;">
            <div class="form">
              <form method="" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8">
                <input id="reg_email" class="form-control" type="text" placeholder="Email" name="email" required="required">
                <input id="reg_password" class="form-control" type="password" placeholder="Пароль" name="password" required="required">
                <input id="password_confirmation" class="form-control" type="password" placeholder="Повторить пароль" name="password_confirmation" required="required">
                <input class="btn btn-default btn-register" type="button" value="Создать аккаунт" name="commit">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="forgot login-footer">
          <span>Хотите создать 
            <a href="javascript: showRegisterForm();">новый аккаунт</a>
          ?</span>
        </div>
        <div class="forgot register-footer" style="display:none">
          <span>У вас уже есть аккаунт?</span>
          <a href="javascript: showLoginForm();">Авторизоваться</a>
        </div>
      </div> 
    </div>
  </div>
</div>

<div class="modal fade" id="AddKonModal">
  <div class="modal-dialog login animated">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Добавить конкурсанта</h4>
      </div>
      <div class="modal-body"> 
        <div class="box">
          <div class="content">
            <div class="error"></div>
            <div class="form">
              <form method="" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8">
                <input id="name" class="form-control" type="text" placeholder="Имя" name="name" required="required">
                <textarea rows="3" id="desc" class="form-control" type="text" placeholder="Описание" name="desc" required="required"></textarea>
                <center><input id="date" type="date" placeholder="Дата добавления" required="required" style="margin-top: 5px;"></center>
                <div class="form-group">
                  <label for="mult">Мультимедия</label>
                  <input type="file" multiple="multiple" accept=".txt,image/*">
                  <a href="#" class="upload_files button">Загрузить файлы</a>
                  <div class="ajax-reply"></div>
                  <center><label for="mult" id="pos"></label></center>
                </div>
                <input class="btn btn-default btn-login" type="button" value="Добавить" onclick="AddKonBut()" style="margin-top: 5px;">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="RedKonModal">
  <div class="modal-dialog login animated">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Редактировать конкурсанта</h4>
      </div>
      <div class="modal-body"> 
        <div class="box">
          <div class="content">
            <div class="error"></div>
            <div class="form">
              <form method="" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8">
                <input id="nameR" class="form-control" type="text" placeholder="Имя" name="name" required="required">
                <textarea rows="3" id="descR" class="form-control" type="text" placeholder="Описание" name="desc" required="required"></textarea>
                <center><input id="dateR" type="date" placeholder="Дата добавления" required="required" style="margin-top: 5px;"></center>
                <div class="form-group">
                  <label for="mult">Мультимедия</label>
                  <input type="file" multiple="multiple" accept=".txt,image/*">
                  <a href="#" class="upload_files button">Загрузить файлы</a>
                  <div class="ajax-reply"></div>
                  <center><label for="mult" id="pos"></label></center>
                </div>
                <input class="btn btn-default btn-login" type="button" value="Редактировать" onclick="RedKonBut()" style="margin-top: 5px;">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</body>
</html>

<script type="text/javascript">
  $(function(){

    $('#add').on('click',function(){ 
      setTimeout(function(){
        $('#AddKonModal').modal('show');    
      }, 230);
    });

    $('.del').on('click',function(){ 
      var idi = $(this).attr('id');
      delKon(idi);
      $('#konn').empty();
      getSpisok(1);
    });

    $('.red').on('click',function(){ 
      var idi = $(this).attr('id');
      localStorage.setItem('var', idi);
      name = $(idi,".name").text();
      desc = $(idi,".disc").text();
      date = $(idi,".data").text();
      console.log(name);
      $("#nameR").val(name);
      $("#descR").val(desc);
      $("#dateR").val(date);
      setTimeout(function(){
        $('#RedKonModal').modal('show');    
      }, 230);
    });

  });

  var getSpisok = function(param) {
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
          var response = $.parseJSON(xhttp.responseText);
          for(i=0;i<response.length;i++) {
            var r = $('<div class="card"><div class="photo"><img src="uploads/'+response[i]["id"]+'.jpg"></div><div class="txt"><div class="name">'+response[i]["name"]+'</div><div class="disc">'+response[i]["text"]+'</div><div class="data">Дата регистрации: '+response[i]["oth"]+' Количество голосов: <b>'+response[i]["kolgol"]+'</b></div></div><div class="red" id="'+response[i]["id"]+'">Редактировать</div><div class="del" id="'+response[i]["id"]+'">Удалить</div></div>');
            $("#konn").append(r);
          }
          
        }
      };
      obj = JSON.stringify({x:param,action:"getSpis1"});
      xhttp.open("POST", '../inc/ajax.php', true);
      xhttp.setRequestHeader("Content-Type","application/json");
      xhttp.send(obj);
  }

  var goloS = function(param) {
    var xhttp = new XMLHttpRequest();
      obj = JSON.stringify({x:param,action:"golos"});
      xhttp.open("POST", '../inc/ajax.php', true);
      xhttp.setRequestHeader("Content-Type","application/json");
      xhttp.send(obj);
  }

  $("#logout").on('click',function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState==4 && xhttp.status==200) {
                    var response = xhttp.responseText;                  
                    if(response=="done") {
                        $('.error').addClass('alert alert-danger').html("Вы вышли из своего кабинета!");
                        setTimeout(timeoutFunc,2000);
                        prs = true;
                        window.location.replace("http://online.ru");
                    }
                    else
                        console.log(222);
                }
            };
                obj = JSON.stringify({action:"logout"});
                xhttp.open("POST", '../inc/ajax.php', true);
                xhttp.setRequestHeader("Content-Type","application/json");
                xhttp.send(obj);
    }); 

  var files; // переменная. будет содержать данные файлов
var nam;
var multz;

// заполняем переменную данными, при изменении значения поля file 
$('input[type=file]').on('change', function(){
  files = this.files;
});

// обработка и отправка AJAX запроса при клике на кнопку upload_files
$('.upload_files').on( 'click', function( event ){

  event.stopPropagation(); // остановка всех текущих JS событий
  event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

  // ничего не делаем если files пустой
  if( typeof files == 'undefined' ) return;

  // создадим объект данных формы
  var data = new FormData();

  // заполняем объект данных файлами в подходящем для отправки формате
  $.each( files, function( key, value ){
    data.append( key, value );
  });

  // добавим переменную для идентификации запроса
  data.append( 'my_file_upload', 1 );

  // AJAX запрос
  $.ajax({
    url         : 'submit.php',
    type        : 'POST', // важно!
    data        : data,
    cache       : false,
    dataType    : 'json',
    // отключаем обработку передаваемых данных, пусть передаются как есть
    processData : false,
    // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
    contentType : false, 
    // функция успешного ответа сервера
    success     : function( respond, status, jqXHR ){

      // ОК - файлы загружены
      if( typeof respond.error === 'undefined' ){
        // выведем пути загруженных файлов в блок '.ajax-reply'
        var files_path = respond.files;
        var html = '';
        $.each( files_path, function( key, val ){
           html += val +'<br>';
           img1 = new Image (200,200);
          img1.src="../uploads/" + files[0]["name"];
          $("#pos").html('');
          $("#pos").append(img1);
        } )

        $('.ajax-reply').html( html );
        nam = files_path;
        var multz = nam[0];
        multz = multz.substr(multz.lastIndexOf('.')+1); 
        console.log(multz);
      }
      // ошибка
      else {
        console.log('ОШИБКА: ' + respond.error );
      }
    },
    // функция ошибки ответа сервера
    error: function( jqXHR, status, errorThrown ){
      console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
    }

  });

});

var AddKonBut = function() {
  name = $("#name").val().replace(/(<.*?>)/g, "");
  desc = $("#desc").val().replace(/(<.*?>)/g, "");
  date = $("#date").val();
  $('.error').empty();
  if (name == "" || desc == "" || date == ""){
    $('.error').addClass('alert alert-danger').html("Не все поля заполнены!");
  }
  else{
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
          var response = xhttp.responseText;
          if(response) {
            console.log(response);
            $('.error').addClass('alert alert-success').html("Конкурсант добавлен");
            $('#konn').empty();
            getSpisok(1);
          } else {
            $('.error').addClass('alert alert-danger').html("Ошибка добавления!");
          }
          
        }
      };
      if(true) {
        obj = JSON.stringify({action:"add",name:name,desc:desc,date:date});
        xhttp.open("POST", '../inc/ajax.php', true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(obj);
      } else {
        //alert("Ошибка!");
      }
  }
  
  }

  var RedKonBut = function() {
  name = $("#nameR").val().replace(/(<.*?>)/g, "");
  desc = $("#descR").val().replace(/(<.*?>)/g, "");
  date = $("#dateR").val();
  id = localStorage.getItem('var');
  $('.error').empty();
  if (name == "" || desc == "" || date == ""){
    $('.error').addClass('alert alert-danger').html("Не все поля заполнены!");
  }
  else{
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
          var response = xhttp.responseText;
          if(response) {
            $('.error').addClass('alert alert-success').html("Конкурсант добавлен");
            $('#konn').empty();
            getSpisok(1);
          } else {
            $('.error').addClass('alert alert-danger').html("Ошибка добавления!");
          }
          
        }
      };
      if(true) {
        obj = JSON.stringify({action:"red",name:name,desc:desc,date:date,id:id});
        xhttp.open("POST", '../inc/ajax.php', true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(obj);
      } else {
        //alert("Ошибка!");
      }
  }
  
  }

  var delKon = function(param) {
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
          
        }
      };
      obj = JSON.stringify({id:param,action:"del"});
      xhttp.open("POST", '../inc/ajax.php', true);
      xhttp.setRequestHeader("Content-Type","application/json");
      xhttp.send(obj);
  }
</script>