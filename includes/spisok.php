<? 
require_once("../inc/db_func.php");
require_once("../inc/config.php");
if(isset($_SESSION["idUser"]))
          {$idid = $_SESSION["idUser"];}
        else{
          $idid = 0;
        }
$keyf = 1;
$kon=getKon($keyf);
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
          echo "<li class='active'><a href='includes/spisok.php'>Список конкурсантов</a></li>";
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
<center><h1>Список всех конкурсантов</h1>
<div id="1" class="fil filiz">по алфавиту</div>
<div id="2" class="fil">по порядку добавления</div>
<div id="3" class="fil">по текущему рейтингу</div></center>
<?
    foreach($kon as $card)
     {

      if (file_exists("../uploads/".$card["id"].".jpg")) {
        $photo = $card["id"];
      }
      else{
        $photo = 0;
      }

      echo <<<NITEM

      <div class="card">
      <div class="photo"><img src="../uploads/{$card["id"]}.jpg"></div>
      <div class="txt">
        <div class="name">{$card["name"]}</div>
        <div class="disc">{$card["text"]}</div>
        <div class="data">Дата регистрации: {$card["oth"]} Количество голосов: {$card["kolgol"]}</div>
      </div>
      <div class="gol">Голосовать!</div>
    </div>

NITEM;
      $posi = $posi + 1;
     }

    ?>

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
</div>
</body>
</html>

<script type="text/javascript">
  $(function(){

    $('#2').on('click',function(){ 
      $('#1').removeClass("filiz");
      $('#2').addClass("filiz");
    });
  });
</script>