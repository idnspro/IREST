<?php
session_start();
require_once("includes/common.php");
require_once("includes/database-table.php");
require_once("includes/functions/general.php");
require_once("includes/classes/class.DB.php");
require_once("includes/classes/class.Admins.php");
$dbObj = new DB();
$dbObj->fun_db_connect();

$adminsObj 		= new Admins();
$errorMsg 		= "";
$errorArray 	= "";
$errorArray['name_error'] 		= '';
$errorArray['password_error'] 	= '';
if($_POST['securityKey'] == md5("ADMINLOGIN")){
	if(trim($_POST['user_name']) == ''){
		$errorArray['name_error'] = 'Username required';
	}
	if(trim($_POST['user_password']) == ''){
		$errorArray['password_error'] = 'Password required';
	}
	if(trim($_POST['user_name']) != '' && trim($_POST['user_password']) != ''){
	    $adminName 		= $_POST['user_name'];
    	$adminPassword 	= $_POST['user_password'];
		if($adminsObj->fun_verifyAdmins($adminName, $adminPassword)){	
			$adminsDets = $adminsObj->fun_getAdminInfo(0, $adminName);
			if(($adminsDets["user_status"]=="1") && ($adminsDets["is_admin"]=="1")){
				$_SESSION['ses_admin_id'] 		= $adminsDets["user_id"];
				$_SESSION['ses_admin_fname'] 	= $adminsDets["user_fname"];
				$_SESSION['ses_admin_email'] 	= $adminsDets["user_email"];
				$_SESSION['ses_admin_pass'] 	= $adminsDets["user_pass"];
				redirectURL("admin-home.php"); // admin dashboard
			} else {
				$errorMsg = "Your account has been suspended due to some reasons.";
			}
		} else {
			$errorMsg = "Invalid Username or Password!";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>IDNS-Restaurant:: Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="css/ie7.css" type="text/css" /><![endif]-->
<!--[if IE 8]><link rel="stylesheet" href="css/ie8.css" type="text/css" /><![endif]-->
<script type="text/javascript" language="javascript">
	function validatefrm(){
    	document.frmLogin.submit();
	}
</script>
</head>
<body>
<div id="header">
    <div class="header-left"> <img src="<?php echo SITE_ADMIN_IMAGES;?>header-left.gif" alt="" /> </div>
    <div class="header-bg">
        <div class="logo"><img src="<?php echo SITE_ADMIN_IMAGES;?>logo.gif" alt="" /></div>
        <div id="header-content">
            <div class="login-area">&nbsp;</div>
            <div class="top-nav">
        <table width="858" height="10" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a class="icon1" href="admin-home.php"><span>Dashboard</span></a></td>
            <td><a class="icon2" href="admin-content.php"><span>Content</span></a></td>
            <td><a class="icon3" href="admin-restaurant.php"><span>Restaurants</span></a></td>
            <td><a class="icon4" href="admin-user.ph"><span>Users</span></a></td>
            <td><a class="icon5" href="admin-event.php"><span>Events</span></a></td>
            <td><a class="icon6" href="admin-report.php"><span>Reports</span></a></td>
            <td><a class="icon7" href="admin-newsletter.php"><span>Newsletter</span></a></td>
            <td><a class="icon8" href="admin-settings.ph"><span>Settings</span></a></td>
          </tr>
        </table>
      </div>
        </div>
    </div>
    <div class="header-right"> <img src="<?php echo SITE_ADMIN_IMAGES;?>header-right.gif" alt="" /> </div>
</div>
<div id="wrapper">
    <div id="admin-login">
        <form action="" method="post" name="frmLogin" id="frmLogin" class="login">
            <input type="hidden" name="securityKey" value="<?php echo md5(ADMINLOGIN);?>" />
            <fieldset>
                <legend>Forgot your password?</legend>
                <p class="pad-btm5 pad-top5"><label for="txtUserEmail">Enter your email address</label> <input name="txtUserEmail" type="text" id="txtUserEmailId" value="" /></p>
                <p><label for="forgot_password">&nbsp;</label><a href="javascript:void(0);" style="text-decoration:none;"><img src="<?php echo SITE_ADMIN_IMAGES;?>submit_btn.gif" border="0" onclick="return validatefrm();" /></a></p>
            </fieldset>
        </form>
    </div>
</div>
<div id="footer">
    <?php require_once(SITE_ADMIN_INCLUDES_PATH.'admin-footer.php'); ?>
</div>
</body>
</html>
