<?php
//form submission
$form_array = array();
$errorMsg 	= "no";
// Add new User : Start here 
if($_POST['securityKey']==md5(ADDNEWUSER)){	

}

if($_POST['securityKey']==md5(EDITUSER)){	
	
}


// Add new User : End here 
if(isset($_GET['sec']) && $_GET['sec'] !="") {
	switch($_GET['sec']) {
		case "add":
		case "edit":
			require_once(SITE_ADMIN_INCLUDES_PATH.'unlike-coupons-form.php');
		break;
		default:
			require_once(SITE_ADMIN_INCLUDES_PATH.'unlike-coupons-list.php');
	}
  } else {
      require_once(SITE_ADMIN_INCLUDES_PATH.'unlike-coupons-list.php');
}
?>