<?php
	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	// Add Option Category submit : Start here 
	if($_POST['securityKey']==md5("ADDEDITOPTCATEGORY")){	
		if(trim($_POST['category_name']) == '') {
			$form_array['category_name_error'] = 'Category name required';
			$errorMsg = 'yes';
		}

		if($errorMsg == 'no' && $errorMsg != 'yes') {
		    $category_name	= $_POST['category_name'];
			$menu_catids	= $_POST['menu_catids'];
			$display_type	= $_POST['display_type'];
			// Add Option Category
			$category_id 	= $restObj->fun_addOptionCategory($category_name, $menu_catids, $display_type);
			$redirect_url 	= "admin-settings.php?sec=option&action=edit&category_id=".$category_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Add Option Category submit : End here 

	// Edit Option Category submit : Start here 
	if($_POST['securityKey']==md5("EDITOPTCATEGORY")){	
		if(trim($_POST['category_name']) == '') {
			$form_array['category_name_error'] = 'Category name required';
			$errorMsg = 'yes';
		}
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$category_id	= $_POST['category_id'];
			$category_name	= $_POST['category_name'];
			$menu_catids	= $_POST['menu_catids'];
			$display_type	= $_POST['display_type'];
			// Edit Option Category
			$restObj->fun_editOptionCategory($category_id, $category_name, $menu_catids, $display_type);
			$redirect_url 	= "admin-settings.php?sec=option&action=edit&category_id=".$category_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit Option Category submit : End here 

	// Add option submit : Start here 
	if($_POST['securityKey']==md5("ADDOPT")){	
		if(trim($_POST['option_name']) == '') {
			$form_array['option_name_error'] = 'Option name required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$category_id	= $_POST['category_id'];
			$option_name	= $_POST['option_name'];
			// Edit option
			$option_id 		= $restObj->fun_addOption($category_id, $option_name);
			$redirect_url 	= "admin-settings.php?sec=option&show=option&action=edit&category_id=".$category_id."&option_id=".$option_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Add option submit : End here 

	// Edit option submit : Start here 
	if($_POST['securityKey']==md5("EDITOPT")){	
		if(trim($_POST['option_name']) == '') {
			$form_array['option_name_error'] = 'Option name required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$option_id		= $_POST['option_id'];
			$category_id	= $_POST['category_id'];
			$option_name	= $_POST['option_name'];
			// Edit option
			$restObj->fun_editOption($option_id, $category_id, $option_name);
			$redirect_url 	= "admin-settings.php?sec=option&show=option&action=edit&category_id=".$category_id."&option_id=".$option_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit option submit : End here 

	//Includes inner pages
	if(isset($_GET['action']) && $_GET['action'] !=""){
		if(isset($_GET['show']) && $_GET['show'] == "option") {
			$addtitle 		= "Manage option";
			$option_id		= $_REQUEST['option_id'];
			$category_id	= $_REQUEST['category_id'];
			$category_name 	= $restObj->fun_getMenuOptionCategoryNameById($category_id);
			include(SITE_ADMIN_INCLUDES_PATH.'option-form.php');
		} else {
			$addtitle 		= "Manage option category";
			$category_id	= $_REQUEST['category_id'];
			include(SITE_ADMIN_INCLUDES_PATH.'option-category-form.php');
		}
	} else {
		if(isset($_GET['show']) && $_GET['show'] == "option") {
			$addtitle 		= "Manage option";
			$category_id	= $_GET['category_id'];
			$category_name 	= $restObj->fun_getMenuOptionCategoryNameById($category_id);
			include(SITE_ADMIN_INCLUDES_PATH.'option-list.php');
		} else {
			$addtitle 		= "Manage option category";
			include(SITE_ADMIN_INCLUDES_PATH.'option-category-list.php');
		}
	}
?>