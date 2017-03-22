<?php
	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	if($_POST['securityKey']==md5("EDITRESTAURANTINFO")){
		/*
		if(trim($_POST['menu_name']) == '') {
			$form_array['menu_name_error'] = 'Menu Name required';
			$errorMsg = 'yes';
		}
		*/
			
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$rest_id        = $_POST['rest_id'];
			$back_url 	    = $_POST['back_url'];
			// Edit Restaurant Info
			$restObj->fun_editRestaurant($rest_id);
			$redirect_url 	= "admin-restaurant-info.php?rest_id=".$rest_id."&back_url=".$back_url;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}		
	}

	if(isset($_GET['sec']) && $_GET['sec'] !="") {
		switch($_GET['sec']) {
			case "add":
			case "edit":
				require_once(SITE_ADMIN_INCLUDES_PATH.'info-form.php');
			break;
			default:
				require_once(SITE_ADMIN_INCLUDES_PATH.'info-form.php');
		}
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'info-form.php');
	}
?>