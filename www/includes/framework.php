<!DOCTYPE html>
<html>
<?
   require_once("includes/head.php");
?>
<body>
    <?
    include_once("includes/header.php");
    if(isset($_SESSION["idUser"]))
    	include_once("includes/content.php");
	else
		include_once("includes/main.php");
    ?>
</body>
</html>