<?php
function connect_db($db_param)
{
    $conn = mysqli_connect($db_param["server"], $db_param["user"], $db_param["pass"], $db_param["base"]);
    if ($conn)
      mysqli_set_charset($conn, "utf8");
    return $conn;
}

function getKon($keyf)
{

    if ($keyf == 1)
        $filter = "name asc";
    if ($keyf == 2)
        $filter = "oth desc";
    if ($keyf == 3)
        $filter = "kolgol desc";

    {
    global $db_param;
    $conn = connect_db($db_param);
    if ($conn != null) {
        $query = "SELECT id, name, text, oth, kolgol FROM konkurs order by $filter limit 5";
        $result = mysqli_query($conn, $query);
    if ( mysqli_num_rows($result) > 0) {
        $housesInfo=array();
        while($hi=mysqli_fetch_array($result))
           $housesInfo[]=$hi;
        mysqli_free_result($result);
        return $housesInfo;}


      return null;

    }
    return null;

}
}

function prov($keyf)
{
    
global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
        if(!($stmt=$conn->prepare("SELECT golos FROM users where id =?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('d',$l)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $l=$keyf;
        if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
                while($bi=mysqli_fetch_array($res))
                    $gradInfo[]=$bi;                
            } else {
                return null;
            }
        }
        $stmt->close();
        return json_encode($gradInfo);
    }

}

function getKonAd($keyf)
{

    {
    global $db_param;
    $conn = connect_db($db_param);
    if ($conn != null) {
        $query = "SELECT id, name, text, oth, kolgol FROM konkurs order by name asc";
        $result = mysqli_query($conn, $query);
    if ( mysqli_num_rows($result) > 0) {
        $housesInfo=array();
        while($hi=mysqli_fetch_array($result))
           $housesInfo[]=$hi;
        mysqli_free_result($result);
        return $housesInfo;}


      return null;

    }
    return null;

}
}

function getKon1($json)
{
    $keyf=$json->x;

    if ($keyf == 1)
        $filter = "name asc";
    if ($keyf == 2)
        $filter = "oth desc";
    if ($keyf == 3)
        $filter = "kolgol desc";

    {
    global $db_param;
    $conn = connect_db($db_param);
    if ($conn != null) {
        $query = "SELECT id, name, text, oth, kolgol FROM konkurs order by $filter limit 5";
        $result = mysqli_query($conn, $query);
    if ( mysqli_num_rows($result) > 0) {
        $housesInfo=array();
        while($hi=mysqli_fetch_array($result))
           $housesInfo[]=$hi;
        mysqli_free_result($result);
        return $housesInfo;}


      return null;

    }
    return null;

}
}

function getKon2($json)
{
    $keyf=$json->x;

    if ($keyf == 1)
        $filter = "name asc";
    if ($keyf == 2)
        $filter = "oth desc";
    if ($keyf == 3)
        $filter = "kolgol desc";

    {
    global $db_param;
    $conn = connect_db($db_param);
    if ($conn != null) {
        $query = "SELECT id, name, text, oth, kolgol FROM konkurs order by $filter";
        $result = mysqli_query($conn, $query);
    if ( mysqli_num_rows($result) > 0) {
        $housesInfo=array();
        while($hi=mysqli_fetch_array($result))
           $housesInfo[]=$hi;
        mysqli_free_result($result);
        return $housesInfo;}


      return null;

    }
    return null;

}
}

function getCard($json)
{
    
global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
        if(!($stmt=$conn->prepare("SELECT name, text, oth FROM konkurs where id =?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('d',$l)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $l=$json->x;
        if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
                while($bi=mysqli_fetch_array($res))
                    $gradInfo[]=$bi;                
            } else {
                return null;
            }
        }
        $stmt->close();
        return json_encode($gradInfo);
    }

}

function golos($json)
{

    global $db_param;

    $conn = connect_db($db_param);
    if ($conn != null) {
        if(!($stmt=$conn->prepare("update konkurs set kolgol = kolgol + 1 where id=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('d',$i)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $i=$json->x;  
        $res =  $stmt->execute();       
        $stmt->close();
        return $res;
    }
    return false;
}

function otmet($json)
{

    global $db_param;

    $today = date("Y-m-d");

    $conn = connect_db($db_param);
    if ($conn != null) {
        if(!($stmt=$conn->prepare("update users set golos = 0, datgol = CURDATE() where id=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('d',$i)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $i=$json->x;  
        $res =  $stmt->execute();       
        $stmt->close();
        return $res;
    }
    return false;
}

function obnulda($json)
{

    global $db_param;

    $conn = connect_db($db_param);
    if ($conn != null) {
        if(!($stmt=$conn->prepare("update users set golos = 1, datgol = CURDATE() where id=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('d',$i)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $i=$json;  
        $res =  $stmt->execute();       
        $stmt->close();
        return $res;
    }
    return false;
}

function obnul($keyf)
{
    global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
        if(!($stmt=$conn->prepare("SELECT datgol FROM users where id =?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('d',$l)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $l=$keyf;
        if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
                while($bi=mysqli_fetch_array($res))
                    $gradInfo[]=$bi;                
            } else {
                return null;
            }
        }
        $stmt->close();
        return json_encode($gradInfo);
    }
}

function checkUser($json)
{
    global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
        if(!($stmt=$conn->prepare("SELECT id FROM users where login=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('s',$l)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $l=$json->log;
        if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
                while($bi=mysqli_fetch_array($res))
                    $gradInfo[]=$bi;                
            } else {
                return null;
            }
        }
        $stmt->close();
        return json_encode($gradInfo);
    }

}

function saveUser($json)
{
    global $db_param;

    $conn = connect_db($db_param);
    if ($conn != null) {
        if(!($stmt=$conn->prepare("insert into users (login,pass,golos) values(?,?,1)"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('ss',$a,$b)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $a=$json->log;
        $b=$json->pas;  
        $res =  $stmt->execute();       
        $stmt->close();
        return $res;
    }
    return false;

}

function addZap($json)
{
    global $db_param;

    $conn = connect_db($db_param);
    if ($conn != null) {
        if(!($stmt=$conn->prepare("insert into konkurs (name,text,oth,kolgol) values(?,?,?,0)"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('sss',$a,$b,$c)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $a=$json->name;
        $b=$json->desc;
        $c=$json->date; 
        $res =  $stmt->execute();       
        $stmt->close();
        return $res;
    }
    return false;

}

function delKu($json)
{
    global $db_param;

    $conn = connect_db($db_param);
    if ($conn != null) {
            if(!($stmt=$conn->prepare("delete from konkurs where id=?"))) {
                echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
            }
            if(!$stmt->bind_param('d',$b)) {
                echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
            }
            $b=$json->id;

            $res =  $stmt->execute();       
            $stmt->close();
            return $res;
    }

    return false;

}

function redZap($json)
{
    global $db_param;

    $conn = connect_db($db_param);
    if ($conn != null) {
        if(!($stmt=$conn->prepare("update konkurs set name=?,text=?,oth=? where id=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('sssd',$a,$b,$c,$d)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $a=$json->name;
        $b=$json->desc;
        $c=$json->date; 
        $d=$json->id;
        $res =  $stmt->execute();       
        $stmt->close();
        return $res;
    }
    return false;

}


class myClass {

        function connect_db($db_param)
    {
        $conn = mysqli_connect($db_param["server"], $db_param["user"], $db_param["pass"], $db_param["base"]);
        if ($conn)
          mysqli_set_charset($conn, "utf8");
        return $conn;
    }

function getName($json)
{
    global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
        if(!($stmt=$conn->prepare("SELECT login FROM users where id=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('s',$a)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $a = $json->id;
        if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
                while($bi=mysqli_fetch_array($res))
                    $gradInfo[]=$bi;
                
            } else {
                return null;
            }
        }
        $stmt->close();
        return json_encode($gradInfo);
    }
}

function getDa($json)
{
    global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
        if(!($stmt=$conn->prepare("SELECT title, start, end, description, mult FROM sub where user=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('d',$a)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $a = $json->id;
        if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
                while($bi=mysqli_fetch_array($res))
                    $gradInfo[]=$bi;
                
            } else {
                return null;
            }
        }
        $stmt->close();
        return json_encode($gradInfo);
    }
}

function getKol()
{
    global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
        if(!($stmt=$conn->prepare("SELECT id, login FROM users"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
                while($bi=mysqli_fetch_array($res))
                    $gradInfo[]=$bi;                
            } else {
                return null;
            }
        }
        $stmt->close();
        return json_encode($gradInfo);
    }
}

function addZap($json)
{
    global $db_param;

    $conn = connect_db($db_param);
    if ($conn != null) {
        if(!($stmt=$conn->prepare("insert into sub (title,description,start,end,user,mult) values(?,?,?,?,?,?)"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('ssssss',$a,$b,$c,$d,$e,$i)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $a=$json->name;
        $b=$json->text;
        $c=$json->start;
        $d=$json->end;
        $e=$json->id;
        $i=$json->mult;  
        $res =  $stmt->execute();       
        $stmt->close();
        return $res;
    }
    return false;

}

function zapUser($json)
{
    global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
        if(!($stmt=$conn->prepare("SELECT title, description, start, end FROM sub where user=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('s',$a)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $a = $json->id;
        if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
        if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
                while($bi=mysqli_fetch_array($res))
                    $gradInfo[]=$bi;
                
            } else {
                return null;
            }
        }
        $stmt->close();
        return json_encode($gradInfo);
    }

}

function editEv($json)
{
    global $db_param;

    $conn = connect_db($db_param);
    if ($conn != null) {
        if(!($stmt=$conn->prepare("update sub set title=?, description=?, start=?, end=?, mult=? where id=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
        if(!$stmt->bind_param('sssssd',$a,$b,$c,$d,$e,$i)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
        $a=$json->name;
        $b=$json->text;
        $c=$json->start;
        $d=$json->end;
        $e=$json->mult;
        $i=$json->id;  
        $res =  $stmt->execute();       
        $stmt->close();
        return $res;
    }
    return false;

}

function logUser($json)
{
    global $db_param;
    $conn = connect_db($db_param);
	$hash = substr(sha1($json->pas),0,32);
    if ($conn != null) {
		if(!($stmt=$conn->prepare("SELECT id FROM users where login=? and pass=?"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
		if(!$stmt->bind_param('ss',$l,$p)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
		$l = $json->log;
        $p = $json->pas;
		if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
		if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
				while($bi=mysqli_fetch_array($res))
					$gradInfo[]=$bi;
				
            } else {
                return null;
            }
        }
		$stmt->close();
		return json_encode($gradInfo);
}
}

function getttData($json)
{
    global $db_param;
    $conn = connect_db($db_param);

    if ($conn != null) {
		if(!($stmt=$conn->prepare("SELECT id, title, datee, textt, mult, user FROM event"))) {
            echo "Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error;
        }
		if(!$stmt->bind_param('d',$a)) {
            echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;
        }
		$a=$json->id;
		if(!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
		if(!($res=$stmt->get_result())) {
            echo "Не удалось получить результат: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            if($res>0){
                $gradInfo=array();
				while($bi=mysqli_fetch_array($res))
					$gradInfo[]=$bi;				
            } else {
                return null;
            }
        }
		$stmt->close();
		return json_encode($gradInfo);
        /*$query = "SELECT * FROM graduates LEFT JOIN directions_old ON (directions_old.id_direction = graduates.id_direction) where id_graduate=$json->id";
        $result = mysqli_query($conn, $query);
        if ( mysqli_num_rows($result) > 0) {
            $gradInfo=array();
            while($bi=mysqli_fetch_array($result))
                $gradInfo[]=$bi;
            return json_encode($gradInfo);
		}
        mysqli_free_result($result);
        return null;*/
    }
    //return null;

}
}


