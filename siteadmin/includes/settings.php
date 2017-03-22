<?php
	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	// Add new restaurant submit : Start here 
	if($_POST['securityKey']==md5("SITEVARIABLES")){	
		if(trim($_POST['site_variable_value']) == '') {
			$form_array['site_variable_value_error'] = 'Setting value required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$site_variable_id		= $_POST['site_variable_id'];
			$site_variable_value	= $_POST['site_variable_value'];
			$site_variable_id 		= $systemObj->fun_editSiteVariable($site_variable_id, $site_variable_value);
			$redirect_url 			= "admin-settings.php?action=edit&site_variable_id=".$site_variable_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Add new restaurant submit : End here 
	if(isset($_GET['action']) && $_GET['action'] !="") {
		$site_variable_id = $_REQUEST['site_variable_id'];
		require_once(SITE_ADMIN_INCLUDES_PATH.'setting-form.php');
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'setting-list.php');
	}
?>
