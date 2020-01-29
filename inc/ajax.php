<?php
include_once('db_func.php');
include_once('config.php');
header("Content-Type: application/json");
$json = json_decode(stripslashes(file_get_contents("php://input")));
$action=$json->action;
$myClass = new myClass();

if($action=="getSpis"){
	$response = getKon1($json);
	echo json_encode($response);
}
if($action=="reg"){
	$response = $myClass->saveUser($json);
	echo json_encode($response);
}
if($action=="add"){
	$response = $myClass->addZap($json);
	echo json_encode($response);
}
if($action=="zap"){
	$response = $myClass->zapUser($json);
	echo $response;
}
if($action=="log"){
	$response = $myClass->logUser($json);
	echo $response;
}
if($action=="edit"){
	$response = $myClass->editEv($json);
	echo $response;
}
if($action=="del"){
	$response = $myClass->delEv($json);
	echo $response;
}
if($action=="getname"){
	$response = $myClass->getName($json);
	echo $response;
}
if($action=="getda"){
	$response = $myClass->getDa($json);
	echo $response;
}
if($action=="getKol"){
	$response = $myClass->getKol();
	echo $response;
}
if($action=="opens"){
	$id=$json->id;
	if (is_int($id)){
		$_SESSION["idUser"]=$id;
	echo "done";
	}
	
}
if($action=="logout"){
	unset($_SESSION["idUser"]);
	echo "done";
}
if($action=="check"){
	$response = $myClass->checkUser($json);
	echo json_encode($response);
}
?>