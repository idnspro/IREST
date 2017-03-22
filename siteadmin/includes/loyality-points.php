<?php
//form submission
$form_array = array();
$errorMsg 	= "no";
// Add new Loyality : Start here 
if($_POST['securityKey']==md5(ADDLOYALITY)){
        if(trim($_POST['rest_name']) == '') {
			$form_array['rest_name_error'] = 'Name required';
			$errorMsg = 'yes';
		}
		
	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$rest_name			= $_POST['rest_name'];
			
			// Add New Loyality 
			$rest_id 			= $restObj->fun_addRestaurant($rest_name, $rest_country_id, $rest_state_id, $rest_city, $rest_address1, $rest_address2, $rest_zip);
			$redirect_url 		= "admin-restaurant.php?sec=edit&subsec=det&rest_id=".$rest_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}		

}

if($_POST['securityKey']==md5(EDITLOYALITY)){	
	
}


// Add new Loyality : End here 
if(isset($_GET['sec']) && $_GET['sec'] !="") {
	switch($_GET['sec']) {
		case "add":
		case "edit":
			require_once(SITE_ADMIN_INCLUDES_PATH.'loyality-form.php');
		break;
		default:
			require_once(SITE_ADMIN_INCLUDES_PATH.'loyality-list.php');
	}
  } else {
      require_once(SITE_ADMIN_INCLUDES_PATH.'loyality-list.php');
}
?>