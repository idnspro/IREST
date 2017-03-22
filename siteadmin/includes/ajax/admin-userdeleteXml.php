<?php
ob_start();
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

require_once("../../includes/common.php");
require_once("../../includes/database-table.php");
require_once("../../includes/classes/class.DB.php");
require_once("../../includes/functions/general.php");
require_once("../../includes/classes/class.Users.php");

$dbObj 		= new DB();
$usersObj 	= new Users();
$dbObj->fun_db_connect();

$strXmlContent 	= "";
if(isset($_GET['user_id']) && $_GET['user_id'] !=""){
	$user_id = $_GET['user_id'];
	// Step I: Select details of image
	$usersObj->fun_delUser($user_id);
	$strXmlContent .="<user>";
	$strXmlContent .="<userstatus>user deleted.</userstatus>\n";
	$strXmlContent .="</user>";
} else {
	$strXmlContent .="<user>";
	$strXmlContent .="<userstatus>Error.</userstatus>\n";
	$strXmlContent .="</user>";
}

$strXml ='<?xml version="1.0" encoding="ISO-8859-1"?><users>';
$strXml .=$strXmlContent;
$strXml .='</users>';
ob_clean();
echo $strXml;
ob_end_flush();
flush();
?>