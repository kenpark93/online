<?
session_start();
if ( !ini_get( 'display_errors' ) ) {
    ini_set( 'display_errors', 1 );
}
ini_set( 'log_errors', 0 );


$db_param=array();
$db_param["server"]="localhost";
$db_param["base"]="online";
$db_param["user"]="mysql";
$db_param["pass"]="mysql";

?>