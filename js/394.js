function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Регистрация');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Авторизация');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}

function showAddKon(){
    $('#AddKonModal').fadeIn('fast'); 
}

function showRedKon(){
    $('#RedKonModal').fadeIn('fast'); 
}

function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}
function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}

function loginAjax(){
    log = $("#login").val().replace(/(<.*?>)/g, "");
    pas = $("#password").val().replace(/(<.*?>)/g, "");
    var iLogin=$("#login");
    bValid=true;
    var reLog = /^[a-zA-Zа-яА-Я0-9]+$/ui;
    if(!reLog.test(log)) 
    {
        shakeModalLog();
        bValid=false;
    }
    var iPass=$("#password");
    if(!reLog.test(pas)) 
    {
        shakeModalPas();
        bValid=false;
    }
    if (bValid==true)
    {
        authUser(log,pas);
    }
}

function shakeModalLog(){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html("Логин не верен или не задан!");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

function shakeModalPas(){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html("Пароль не верен или не задан!");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

function shakeModalEr(){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html("Ошибка авторизации!");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

var authUser = function(log,pass) {
        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState==4 && xhttp.status==200) {
                    var response =$.parseJSON(xhttp.responseText);
                    if(response!="") {
                        id = response[0]["id"];
                        localStorage.setItem('idu', id);
                        console.log(id)
                        openSession();
                    } else {
                        shakeModalEr();
                    }
                    
                }
            };
            if(true) {
                obj = JSON.stringify({action:"log",log:log,pas:pass});
                xhttp.open("POST", '../inc/ajax.php', true);
                xhttp.setRequestHeader("Content-Type","application/json");
                xhttp.send(obj);
            } else {
                    shakeModalEr();
            }
    }

var openSession = function() {
        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState==4 && xhttp.status==200) {
                    var response = xhttp.responseText;                  
                    if(response=="done") {
                        $('.error').addClass('alert alert-success').html("Вы зашли в свой кабинет!");
                        setTimeout(timeoutFunc,2000);
                        prs = true;
                    }
                    else
                        console.log(222);
                }
                
            };
                obj = JSON.stringify({action:"opens",id:id});
                xhttp.open("POST", '../inc/ajax.php', true);
                xhttp.setRequestHeader("Content-Type","application/json");
                xhttp.send(obj);
    }

function timeoutFunc(){
        if (prs){
            prs = false;
            location.reload();
        }
    }






   