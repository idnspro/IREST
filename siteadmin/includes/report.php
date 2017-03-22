<?php

$form_array = array();
$errorMsg 	= "no";
if($_POST['securityKey']==md5(REPORT)){	

}

if($_POST['securityKey']==md5(REPORT)){	
	
}


// Add new User : End here 
if(isset($_GET['sec']) && $_GET['sec'] !="") {
	switch($_GET['sec']) {
		case "order":
			require_once(SITE_ADMIN_INCLUDES_PATH.'order-report.php');
		break;
		case "customer":
			require_once(SITE_ADMIN_INCLUDES_PATH.'customer-report.php');
		break;
		default:
			require_once(SITE_ADMIN_INCLUDES_PATH.'report-list.php');
	}
  } else {
      require_once(SITE_ADMIN_INCLUDES_PATH.'report-list.php');
}
?>

