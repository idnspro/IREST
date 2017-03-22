<?php
ob_start();
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

require_once("../../includes/common.php");
require_once("../../includes/database-table.php");
require_once("../../includes/classes/class.DB.php");
require_once("../../includes/functions/general.php");
require_once("../../includes/classes/class.Restaurant.php");

$dbObj 		= new DB();
$restObj 	= new Restaurant();
$dbObj->fun_db_connect();

$strXml ="";
$strXmlContent ="";
if(isset($_GET['review_id']) && $_GET['review_id'] !=""){
	$review_id = $_GET['review_id'];
	// Step I: Select details of image
	$restObj->fun_delRestaurantReview($review_id);
	$strXmlContent .="<review>";
	$strXmlContent .="<reviewstatus>review deleted.</reviewstatus>\n";
	$strXmlContent .="</review>";
} else {
	$strXmlContent .="<review>";
	$strXmlContent .="<reviewstatus>Error.</reviewstatus>\n";
	$strXmlContent .="</review>";
}

$strXml ='<?xml version="1.0" encoding="ISO-8859-1"?><reviews>';
$strXml .=$strXmlContent;
$strXml .='</reviews>';
ob_clean();
echo $strXml;
ob_end_flush();
flush();
?>