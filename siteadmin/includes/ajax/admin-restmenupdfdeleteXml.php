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

$strXml 		= "";
$strXmlContent 	= "";
if(isset($_GET['pdf_id']) && $_GET['pdf_id'] !=""){
	$pdf_id = $_GET['pdf_id'];
	// Step I: Select details of image
	$restObj->fun_delRestMenuPDFById($pdf_id);
	$strXmlContent .="<pdf>";
	$strXmlContent .="<pdfstatus>pdf deleted.</pdfstatus>\n";
	$strXmlContent .="</pdf>";
} else {
	$strXmlContent .="<pdf>";
	$strXmlContent .="<pdfstatus>Error.</pdfstatus>\n";
	$strXmlContent .="</pdf>";
}

$strXml ='<?xml version="1.0" encoding="ISO-8859-1"?><pdfs>';
$strXml .=$strXmlContent;
$strXml .='</pdfs>';
ob_clean();
echo $strXml;
ob_end_flush();
flush();
?>