<?php
	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	// Edit menu category : Start here 
	if($_POST['securityKey']==md5("ADDMENUCATEGORY")){	
		if(trim($_POST['category_name']) == '') {
			$form_array['category_name_error'] = 'Category name required';
			$errorMsg = 'yes';
		}
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$category_pid		= $_POST['category_pid'];
			$category_name		= $_POST['category_name'];
			$category_id 		= $restObj->fun_addMenuCategory($category_pid, $category_name);
			$redirect_url 		= "admin-settings.php?sec=category&action=edit&category_id=".$category_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit menu category : End here 

	// Edit menu category : Start here 
	if($_POST['securityKey']==md5("EDITMENUCATEGORY")){	
		if(trim($_POST['category_name']) == '') {
			$form_array['category_name_error'] = 'Category name required';
			$errorMsg = 'yes';
		}
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$category_id		= $_POST['category_id'];
			$category_pid		= $_POST['category_pid'];
			$category_name		= $_POST['category_name'];
			$restObj->fun_editMenuCategory($category_id, $category_pid, $category_name);
			$redirect_url 		= "admin-settings.php?sec=category&action=edit&category_id=".$category_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit menu category : End here 

	if(isset($_GET['action']) && $_GET['action'] !="") {
		$category_id = $_REQUEST['category_id'];
		require_once(SITE_ADMIN_INCLUDES_PATH.'category-form.php');
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'category-list.php');
	}
?>
