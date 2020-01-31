<? 
require_once("../inc/db_func.php");
require_once("../inc/config.php");
if(isset($_SESSION["idUser"]))
          {$idid = $_SESSION["idUser"];}
        else{
          $idid = 0;
        }
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
              echo "<li><a href='panel.php'>Работа с конкурсантами</a></li>";
            }
      ?>
      <li class="active"><a href="about.php">О системе</a></li>
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
<center><h1>"Система online-голосования"</h1></center>
<h3>Разработать Web-приложение, предоставляющее возможность определять победителя по результатам online-голосования пользователей. Предусмотреть две роли: администратор и посетитель.<br><br>
Администратор должен иметь возможность редактировать список конкурсантов с описанием и мультимедийным оформлением.<br><br>
Посетителям должна предоставляться возможность просматривать информацию о конкурсантах и голосовать за понравившегося.<br><br>
По результатам голосования в конце дня система должна формировать список конкурсантов с набранными голосами. Предоставить возможность сортировки списка по различным критериям (по алфавиту, порядку добавления, текущему рейтингу).<br><br>
Предусмотреть функцию подавления накручивания счетчика одним и тем же посетителем, не давая ему возможность голосовать чаще, чем один раз в сутки.</h3>
  </div>

 <div class="footer">
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="http://www.volpi.ru/" target="_blank"> Разработано в ВПИ</a> Иванов В.
  </div>

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
                <input id="login" class="form-control" type="text" placeholder="Login" name="login" required="required">
                <input id="password" class="form-control" type="password" placeholder="Пароль" name="password" required="required">
                <input class="btn btn-default btn-login" type="button" value="Авторизоваться" onclick="loginAjax()">
              </form>
            </div>
          </div>
        </div>
        <div class="box">
          <div class="content registerBox" style="display:none;">
            <div class="form" id="regreg">
              <form method="" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8">
                <input id="reg_login" class="form-control" type="text" placeholder="Login" name="login" required="required">
                <input id="reg_password" class="form-control" type="password" placeholder="Пароль" name="password" required="required">
                <input id="password_confirmation" class="form-control" type="password" placeholder="Повторить пароль" name="password_confirmation" required="required">
                <input class="btn btn-default btn-register" type="button" value="Создать аккаунт" onclick="regAjax()">
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
<script type="text/javascript">

  function regAjax(){
        login = $("#reg_login").val().replace(/(<.*?>)/g, "");
        pass = $("#reg_password").val().replace(/(<.*?>)/g, "");
        conf_pass = $("#password_confirmation").val().replace(/(<.*?>)/g, "");
        var bValid=true;                         //Тут проверка начинается регистрации
    //Проверка логина
      var iLog=$("#reg_login");
      var reLog = /^[a-zA-z0-9_]{1,10}$/;
      if(!reLog.test(login)) {
          $('.error').addClass('alert alert-danger').html("Логин не верен!");
          $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
          iLog.css("border-color", "red");
          bValid=false;

      }
      else{
          iLog.css("border-color","#ccc");
        
      }
    
    //Проверка пароля. У пароля и логина совпадают регулярные выражения
    var iPas=$("#reg_password");
    if(!reLog.test(pass)) {
        $('.error').addClass('alert alert-danger').html("Ошибка в пароле!");
        $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
        iPas.css("border-color", "red");
        bValid=false;
    }
    else
    {
        iPas.css("border-color","#ccc");
    }
        

    //Проверка подтверждения пароля
    var iConfPas=$("#password_confirmation");
    if(conf_pass!=pass) {
        $('.error').addClass('alert alert-danger').html("Пароли не совпадают!");
        $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
        iConfPas.css("border-color", "red");
        bValid=false;
    }
    else
    {
        iConfPas.css("border-color","#ccc");
    }
          
    if (bValid==true)
    {
        checkUser();
        
    }
}

var checkUser = function() {
        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState==4 && xhttp.status==200) {
                  console.log(xhttp.responseText);
                    var response = $.parseJSON(xhttp.responseText);
                    if(response==null || response.length<5) {
                        regUser();
                    } else {
                        $('.error').addClass('alert alert-danger').html("Такой логин уже существует!");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
                    }
                    
                }
            };
            if(true) {
                obj = JSON.stringify({action:"check",log:login});
                xhttp.open("POST", '../inc/ajax.php', true);
                xhttp.setRequestHeader("Content-Type","application/json");
                xhttp.send(obj);
            } else {

            }
    }

        var regUser = function() {
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
          var response = xhttp.responseText;//$.parseJSON(xhttp.responseText);
          if(response) {
            $('.error').addClass('alert alert-success').html("Вы зарегистрировались!");
             $('#regreg').empty();
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
          } else {
            $('.error').addClass('alert alert-danger').html("Ошибка регистрации!");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
          }
          
        }
      };
      if(true) {
        obj = JSON.stringify({action:"reg",log:login,pas:pass});
        xhttp.open("POST", '../inc/ajax.php', true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(obj);
      } else {
        //alert("Ошибка!");
      }
  }

  $("#logout").on('click',function(){
            location.reload();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState==4 && xhttp.status==200) {
                    var response = xhttp.responseText;                  
                    if(response=="done") {
                        $('.error').addClass('alert alert-danger').html("Вы вышли из своего кабинета!");
                        setTimeout(timeoutFunc,2000);
                        prs = true;
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
</script>