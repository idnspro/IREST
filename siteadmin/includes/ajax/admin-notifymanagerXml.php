<?php
ob_start();
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
require_once("../../includes/common.php");
require_once("../../includes/database-table.php");
require_once("../../includes/classes/class.DB.php");
require_once("../../includes/functions/general.php");
require_once("../../includes/classes/class.Email.php");
require_once("../../includes/classes/class.Users.php");

$dbObj 		= new DB();
$dbObj->fun_db_connect();

$usersObj 	= new Users();
$strXmlContent = "";
if(isset($_GET['user_login']) && isset($_GET['user_pass']) && $_GET['user_login'] != "" && $_GET['user_pass'] !=""){		
	$user_id 	= $_GET['user_id'];
	$user_name 	= $_GET['user_name'];
	$user_login = $_GET['user_login'];
	$user_pass 	= $_GET['user_pass'];
	$user_email = $_GET['user_email'];

	// Step I: Select details of image
	$usersObj->sendManagerNotificationEmail1($user_id, $user_name, $user_login, $user_pass, $user_email);
	$strXmlContent .="<act>";
	$strXmlContent .="<status>success</status>\n";
	$strXmlContent .="</act>";
} else {
	$strXmlContent .="<act>";
	$strXmlContent .="<status>error</status>\n";
	$strXmlContent .="</act>";
}

$strXml ='<?xml version="1.0" encoding="ISO-8859-1"?><acts>';
$strXml .=$strXmlContent;
$strXml .='</acts>';
ob_clean();
echo $strXml;
ob_end_flush();
flush();
?>