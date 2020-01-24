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
      <li><a href="http://online.ru/">Главная</a></li>
      <li class="active"><a href="">О системе</a></li>
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
<h1> "Система online-голосования"</h1>
<h3>Разработать Web-приложение, предоставляющее возможность определять победителя по результатам online-голосования пользователей. Предусмотреть две роли: администратор и посетитель.<br><br>
Администратор должен иметь возможность редактировать список конкурсантов с описанием и мультимедийным оформлением.<br><br>
Посетителям должна предоставляться возможность просматривать информацию о конкурсантах и голосовать за понравившегося.<br><br>
По результатам голосования в конце дня система должна формировать список конкурсантов с набранными голосами. Предоставить возможность сортировки списка по различным критериям (по алфавиту, порядку добавления, текущему рейтингу).<br><br>
Предусмотреть функцию подавления накручивания счетчика одним и тем же посетителем, не давая ему возможность голосовать чаще, чем один раз в сутки.</h3>
  </div>

  <div class="footer">
  	<div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="http://www.volpi.ru/" target="_blank"> Разработано в ВПИ</a>
    Иванов В.
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
</div>
</body>
</html>