<?php
 
include_once('db_func.php');
include_once('config.php');
    global $db_param;
 
$data = array();
 
if( isset( $_GET['uploadfiles'] ) ){
    $error = false;
    $files = array();
 
    $uploaddir = '../photos/'; // . - текущая папка где находится submit.php
 
    // Создадим папку если её нет
 
    if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );
 
    // переместим файлы из временной директории в указанную
    foreach( $_FILES as $file ){
    	$size = getimagesize($file['tmp_name']);
    	if ($size)
        if( move_uploaded_file( $file['tmp_name'], $uploaddir . $_SESSION["idUser"].".jpg" ) ){
            $files[] = realpath( $uploaddir . $_SESSION["idUser"].".jpg" );
        }
        else{
            $error = true;
        }
        else
        	$error = true;
    }
 
    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files );
 
    echo json_encode( $data );
}
