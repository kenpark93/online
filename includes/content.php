<? 
if(isset($_SESSION["idUser"]))
          {$idid = $_SESSION["idUser"];}
        else{
          $idid = 0;
        }
//$events = getData();
?>
<center><h2>Пользователь <span style="color:red;" id="input4"></span></h2></center>
<div class="wrapper">

</div>

  <div class="footer">
  	<div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href=""> Разработано в ВПИ</a>
  </div>

</div>
<script type="text/javascript">

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
          img1.src="./uploads/" + files[0]["name"];
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

  var idu = <?php echo $idid ?>;
  $(document).ready(function(){
      getUserInfo();
    });
var getUserInfo = function() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
            var response = $.parseJSON(xhttp.responseText);
            
            if(response!=null) {
              var a = response[0]["login"];
                          $("#input4").append(a);
            } else {
              console.log(1111);
            }        
        }
      };
        obj = JSON.stringify({action:"getname",id:idu});
        xhttp.open("POST", '../inc/ajax.php', true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(obj);
    };
var events = <?php echo $events ?>;
var addsob = function() {
  var namez = $("#title").val().replace(/(<.*?>)/g, "");
  var startz = $("#start").val().replace(/(<.*?>)/g, "");
  var endz = $("#end").val().replace(/(<.*?>)/g, "");
  var textz = $("#text").val().replace(/(<.*?>)/g, "");
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
          var response = xhttp.responseText;
          if(response) {
            $('.success').addClass('alert alert-success').html("Вы добавили новое событие!");
                  setTimeout(timeoutFunc,2000);
                        prs = true;      
          } else {
            
          }
          
        }
      };
      if(true) {
        multz = files[0]["name"];
        obj = JSON.stringify({action:"add",id:idu,name:namez,start:startz,end:endz,text:textz,mult:multz});
        xhttp.open("POST", '../inc/ajax.php', true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(obj);
      } else {
        //alert("Ошибка!");
      }
  }

var editsob = function(id) {
  var ide = id;
  var namee = $("#titlee").val().replace(/(<.*?>)/g, "");
  var starte = $("#starte").val().replace(/(<.*?>)/g, "");
  var ende = $("#ende").val().replace(/(<.*?>)/g, "");
  var texte = $("#texte").val().replace(/(<.*?>)/g, "");
  var multe = $("#multe").val().replace(/(<.*?>)/g, "");
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
          var response = xhttp.responseText;
          if(response) {
            $('.success').addClass('alert alert-success').html("Измение записаны!");
                        setTimeout(timeoutFunc,2000);
                        prs = true;
          } else {
            
          }
          
        }
      };
      if(true) {
        console.log(ide);
        obj = JSON.stringify({action:"edit",id:ide,name:namee,start:starte,end:ende,text:texte,mult:multe});
        xhttp.open("POST", '../inc/ajax.php', true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(obj);
      } else {
        //alert("Ошибка!");
      }
  }
var delsob = function(id) {
  var ide = id;
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
          var response = xhttp.responseText;
          if(response) {
            $('.success').addClass('alert alert-success').html("Событие удалено!");
                        setTimeout(timeoutFunc,2000);
                        prs = true;
          } else {
            
          }
          
        }
      };
      if(true) {
        console.log(ide);
        obj = JSON.stringify({action:"del",id:ide});
        xhttp.open("POST", '../inc/ajax.php', true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(obj);
      } else {
        //alert("Ошибка!");
      }
  }
</script>
