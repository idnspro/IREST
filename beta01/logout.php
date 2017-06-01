<?php
/**
 * IREST - Online Food Ordering Script
 *
 * PHP version 5
 *
 * @category  Front-end
 * @package   IREST_FRONTEND
 * @author    IDNS TEAM <support@idns-technologies.com>
 * @copyright 2016-2017 IDNSPro
 * @license   http://idns.com/license.txt EULA
 * @link      http://idns.com
 * Do not copy, cite, or distribute without permission of the author.
 */

/*
|--------------------------------------------------------------------------
| Frontend logout page
|--------------------------------------------------------------------------
|
| It is logout page
|
*/

require_once __DIR__ . '/includes/application-top.php';
$_SESSION['ses_user_id']    = "";
$_SESSION['ses_user_fname'] = "";
$_SESSION['ses_user_email'] = "";
$_SESSION['ses_user_pass']  = "";
$_SESSION['ses_user_home']  = "";
redirectURL("index.php");
