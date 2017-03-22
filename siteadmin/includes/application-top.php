<?php
session_start();
require_once("siteadmin/includes/common.php");
require_once("siteadmin/includes/database-table.php");
require_once("siteadmin/includes/classes/class.DB.php");
require_once("siteadmin/includes/functions/general.php");
require_once("siteadmin/includes/functions/form.php");
require_once("siteadmin/includes/functions/html.php");

$dbObj = new DB();
$dbObj->fun_db_connect();
?>