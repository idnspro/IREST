<?php
$rest_id = $_REQUEST['rest_id'];
//form submission
$form_array = array();
$errorMsg 	= "no";
// Add new Feedback : Start here 
if($_POST['securityKey']==md5(ADD)){
  

}
if($_POST['securityKey']==md5(EDIT)){	
	
}
// Add new Feedback : End here 
if(isset($_GET['sec']) && $_GET['sec'] !="") {
	switch($_GET['sec']) {
		case "add":
		case "edit":
			require_once(SITE_ADMIN_INCLUDES_PATH.'feedback-form.php');
		break;
		default:
			//require_once(SITE_ADMIN_INCLUDES_PATH.'feedback-list.php');
	}
  } else {
     // require_once(SITE_ADMIN_INCLUDES_PATH.'feedback-list.php');
}
?>