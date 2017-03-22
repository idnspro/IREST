<?php
session_start();
/*
error_reporting(E_ALL-E_NOTICE);
ini_set('allow_call_time_pass_reference', true);
ini_set("display_errors", "On");
ini_set("max_execution_time", "0");
*/

require_once("includes/common.php");
require_once("includes/database-table.php");
require_once("includes/functions/general.php");
require_once("includes/functions/form.php");
require_once("includes/functions/html.php");
require_once("includes/classes/class.DB.php");
require_once("includes/classes/class.System.php");
require_once("includes/classes/class.Pagination.php");
require_once("includes/classes/class.Admins.php");
require_once("includes/classes/class.Restaurant.php");
require_once("includes/classes/class.Location.php");
require_once("includes/classes/class.Calender.php");
require_once("includes/classes/class.Users.php");
require_once("includes/classes/class.UserSetting.php");
require_once("includes/classes/class.Image.php");
require_once("includes/classes/class.CMS.php");
require_once("includes/classes/class.Banner.php");
require_once("includes/classes/class.Seo.php");
require_once("includes/classes/class.Resource.php");
require_once("includes/classes/class.Event.php");
require_once("includes/classes/class.Currency.php");
require_once("includes/classes/class.Email.php");


$dbObj = new DB();
$dbObj->fun_db_connect();

$systemObj 		= new System();
$adminsObj 		= new Admins();
$restObj 		= new Restaurant();
$eventObj 		= new Event();
$locationObj 	= new Location();
$calendarObj 	= new Calendar();
$usersObj 		= new Users();
$userSetting	= new UserSetting();
$imgObj 		= new Image();
$cmsObj         = new Cms();
$bannerObj      = new Banner();
$seoObj         = new Seo();
$resObj			= new Resource();
$currencyObj	= new Currency();

$adminsObj->CheckAdminLogin();
?>