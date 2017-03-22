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
require_once("../../includes/classes/class.Restaurant.php");
$dbObj 		= new DB();
$restObj 	= new Restaurant();
$dbObj->fun_db_connect();

$strXmlContent 	= "";
if(isset($_GET['booking_id']) && $_GET['booking_id'] !=""){
	$booking_id = $_GET['booking_id'];
	// Step I: Select details of image
	$restObj->fun_delBooking($booking_id);
	$strXmlContent .="<booking>";
	$strXmlContent .="<bookingstatus>booking deleted.</bookingstatus>\n";
	$strXmlContent .="</booking>";
} else {
	$strXmlContent .="<booking>";
	$strXmlContent .="<bookingstatus>Error.</bookingstatus>\n";
	$strXmlContent .="</booking>";
}

$strXml ='<?xml version="1.0" encoding="ISO-8859-1"?><bookings>';
$strXml .=$strXmlContent;
$strXml .='</bookings>';
ob_clean();
echo $strXml;
ob_end_flush();
flush();
?>