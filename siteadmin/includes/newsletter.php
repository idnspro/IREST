<?php
//form submission
$form_array = array();
$errorMsg 	= "no";
// Add new User : Start here 
if($_POST['securityKey']==md5(ADDNEWSLETTER)){	
   
}
// Add new User : End here 
if(isset($_GET['sec']) && $_GET['sec'] !="") {
	switch($_GET['sec']) {
		case "add":
			require_once(SITE_ADMIN_INCLUDES_PATH.'newsletter-list.php');
		break;
	}
  } else {
      require_once(SITE_ADMIN_INCLUDES_PATH.'newsletter-list.php');
}
?>

