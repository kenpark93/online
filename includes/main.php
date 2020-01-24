<? 
if(isset($_SESSION["idUser"]))
          {$idid = $_SESSION["idUser"];}
        else{
          $idid = 0;
        }
$kol=getCount();
$events = getData();
?>
<div class="wrapper">

  <div class="contentt">

  </div>

  <div class="footer">
  	<div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="http://www.volpi.ru/" target="_blank"> ВПИ. Иванов В.</a></div>
  </div>

</div>
<div id="dialog2">
  <form>
    <div class="success"></div>
  <div class="form-group">
    <label for="title">Название события</label>
    <input type="text" class="form-control" id="title1" placeholder="Название события" required>
  </div>
  <div class="form-group">
    <label for="start">Начало события</label>
    <input type="text" class="form-control datepicker" id="start1" placeholder="Дата начала" required>
  </div>
  <div class="form-group">
    <label for="end">Конец события</label>
    <input type="text" class="form-control datepicker" id="end1" placeholder="Дата конца" required>
  </div>
  <div class="form-group">
    <label for="text">Описание события</label>
    <input type="text" class="form-control" id="text1" placeholder="Описание события">
  </div>
  <div class="form-group">
    <label for="mult">Мультимедия</label>
    <center><label for="mult" id="pos1"></label></center>
  </div>
</form>
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
						<div class="form">
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
  var events = <?php echo $events ?>;
  kol = <?php echo $kol ?>;
  $(document).ready(function(){
      getKol();
    });
  var getKol = function() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (xhttp.readyState==4 && xhttp.status==200) {
					try {
						var response = $.parseJSON(xhttp.responseText);
						if(response!=null) {
							for(i=response.length-1;i>=0;i--) {
								var r = $('<center><h3>Календарь пользователя <span style="color:red;" id="input4">'+response[i]["login"]+'</span></h3></center>');
								$(".contentt").append(r);
								var r = $('<div id="calendar'+response[i]["id"]+'"></div>');
								$(".contentt").append(r);
								var eve = getDa(response[i]["id"]);
								var r = $('<br>');
								$(".contentt").append(r);
							}
							
						} else {

						}
					} catch (e) {

					}
					
				}
			};
				obj = JSON.stringify({action:"getKol"});
				xhttp.open("POST", '../inc/ajax.php', true);
				xhttp.setRequestHeader("Content-Type","application/json");
				xhttp.send(obj);
		};

var getDa = function(id) {
	console.log(id);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
            var response = $.parseJSON(xhttp.responseText);
            
            if(response!=null) {
              $('#calendar' + id).fullCalendar({
    								eventSources: [
    								{
      								events : response,
      								color : '#1AA3A9',
      								textColor : '#fff',
    								}
  										],
    								height: 450,
                    eventClick: function(event) {
                      console.log(event);
                      $('#title1').val(event.title);
                      $('#start1').val(event[1]);
                      $('#end1').val(event[2]);
                      $('#text1').val(event.description);
                      $('#mult1').val(event.mult);
                      event_id = event.id;
                      event_ti = event.title;
                      event_st = event[1];
                      event_en = event[2];
                      event_de = event.description;
                      event_mu = event.mult;
                      if (event_mu) {
                        img2 = new Image (200,200);
                        img2.src="./uploads/" + event_mu;
                        $("#pos1").html('');
                        $("#pos1").append(img2);}
                      $('#dialog2').dialog('open');
                    }
  								});
            } else {
              console.log(1111);
            }        
        }
      };
        obj = JSON.stringify({action:"getda",id:id});
        xhttp.open("POST", '../inc/ajax.php', true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(obj);
    };

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
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
             location.reload();
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
</script>
