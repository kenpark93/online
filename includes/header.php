<header>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://online.ru/">Online.ru</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="http://online.ru/">Результат голосования</a></li>
      <?
        if(isset($_SESSION["idUser"]))
        {
          echo "<li><a href='includes/spisok.php'>Список конкурсантов</a></li>";
          if($_SESSION["idUser"] == 1)
            {
              echo "<li><a href='includes/panel.php'>Добавить конкурсанта</a></li>";
            }
        }
      ?>
      <li><a href="includes/about.php">О системе</a></li>
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
<script type="text/javascript">
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