<?php
ob_start();
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

require_once("../../includes/common.php");
require_once("../../includes/database-table.php");
require_once("../../includes/classes/class.DB.php");
require_once("../../includes/functions/general.php");
require_once("../../includes/classes/class.Resource.php");

$dbObj 		= new DB();
$resObj		= new Resource();
$dbObj->fun_db_connect();

$strXmlContent ="";
if(isset($_GET['resource_id']) && $_GET['resource_id'] !=""){
	$resource_id = $_GET['resource_id'];
	// Step I: Select details of image
	$resObj->fun_delResource($resource_id);
	$strXmlContent .="<resource>";
	$strXmlContent .="<resourcestatus>resource deleted.</resourcestatus>\n";
	$strXmlContent .="</resource>";
} else {
	$strXmlContent .="<resource>";
	$strXmlContent .="<resourcestatus>Error.</resourcestatus>\n";
	$strXmlContent .="</resource>";
}

$strXml ='<?xml version="1.0" encoding="ISO-8859-1"?><resources>';
$strXml .=$strXmlContent;
$strXml .='</resources>';
ob_clean();
echo $strXml;
ob_end_flush();
flush();
?>