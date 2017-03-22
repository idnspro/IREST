<?php
	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	// Edit menu Resource : Start here 
	if($_POST['securityKey']==md5("EDITRESOURCE")){	
		if(trim($_POST['resource_cat_ids']) == '') {
			$form_array['resource_cat_ids_error'] = 'Resource cat ids required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['resource_name']) == '') {
			$form_array['resource_name_error'] = 'Resource name required';
			$errorMsg = 'yes';
		}
		
		if(trim($_POST['resource_description']) == '') {
			$form_array['resource_description_error'] = 'Resource description required';
			$errorMsg = 'yes';
		}
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$resource_id		= $_POST['resource_id'];
			$resource_cat_ids	= $_POST['resource_cat_ids'];
			$resource_name		= $_POST['resource_name'];
			$resource_description= $_POST['resource_description'];
			$resource_country_id= $_POST['resource_country_id'];
			$resource_state_id 	= $_POST['resource_state_id'];
			$resource_city_id 	= $_POST['resource_city_id'];
			$resource_link		= $_POST['resource_link'];
			$resource_mc_link 	= $_POST['resource_mc_link'];
			$active				= $_POST['active'];
			$resource_id 		= $resObj->fun_editResource($resource_id, $resource_cat_ids, $resource_name, $resource_description, $resource_country_id, $resource_state_id, $resource_city_id, $resource_link, $resource_mc_link, $active);
			$redirect_url 		= "admin-settings.php?sec=resource&action=edit&resource_id=".$resource_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit menu Resource : End here 

	if(isset($_GET['action']) && $_GET['action'] !="") {
		$resource_id = $_REQUEST['resource_id'];
		require_once(SITE_ADMIN_INCLUDES_PATH.'resource-form.php');
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'resource-list.php');
	}
?>
