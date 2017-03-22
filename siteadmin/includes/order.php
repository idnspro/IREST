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
	if($_POST['securityKey']==md5("EDITORDER")){	
		if(trim($_POST['delivery_fname']) == '') {
			$form_array['delivery_fname_error'] = 'First name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['delivery_address1']) == '') {
			$form_array['delivery_address1_error'] = 'Delivery address required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['dtype']) == '') {
			$form_array['dtype_error'] = 'Delivery type required';
			$errorMsg = 'yes';
		}
		if($errorMsg == 'no' && $errorMsg != 'yes') {
			$order_id 				= $_POST['order_id'];
			$user_id 				= $_POST['user_id'];
			$delivery_fname 		= $_POST['delivery_fname'];
			$delivery_lname 		= $_POST['delivery_lname'];
			$delivery_address1 		= $_POST['delivery_address1'];
			$delivery_address2 		= $_POST['delivery_address2'];
			$delivery_city 			= $_POST['delivery_city'];
			$delivery_state 		= $_POST['delivery_state'];
			$delivery_country 		= $_POST['delivery_country'];
			$delivery_zip 			= $_POST['delivery_zip'];
			$delivery_phone			= $_POST['delivery_phone'];
			$dtype 					= $_POST['dtype'];
			$schedule 				= $_POST['schedule'];
			$order_comments 		= $_POST['order_comments'];
			$payment_method 		= $_POST['payment_method'];
			$cc_type 				= $_POST['cc_type'];
			$cc_owner 				= $_POST['cc_owner'];
			$cc_number 				= $_POST['cc_number'];
			$cc_expires 			= $_POST['cc_expires'];
			$final_price 			= $_POST['final_price'];
			$currency_id 			= $_POST['currency_id'];
			$orders_status 			= $_POST['orders_status'];

			// Edit Order
			$restObj->fun_editOrder($order_id, $user_id, $delivery_fname, $delivery_lname, $delivery_address1, $delivery_address2, $delivery_city, $delivery_state, $delivery_country, $delivery_zip, $delivery_phone, $dtype, $schedule, $order_comments, $payment_method, $cc_type, $cc_owner, $cc_number, $cc_expires, $final_price, $currency_id, $orders_status);
			$redirect_url 	= "admin-report.php?sec=order&action=edit&order_id=".$order_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}
	// Edit Option Category submit : End here 

	//Includes inner pages
	if(isset($_GET['action']) && $_GET['action'] !=""){
		if(isset($_GET['show']) && $_GET['show'] == "option") {
			$addtitle 		= "Manage option";
			$option_id		= $_REQUEST['option_id'];
			$category_id	= $_REQUEST['category_id'];
			$category_name 	= $restObj->fun_getMenuOptionCategoryNameById($category_id);
			include(SITE_ADMIN_INCLUDES_PATH.'option-form.php');
		} else {
			$addtitle 		= "Manage Orders";
			$order_id		= $_REQUEST['order_id'];
			include(SITE_ADMIN_INCLUDES_PATH.'order-form.php');
		}
	} else {
		if(isset($_GET['show']) && $_GET['show'] == "view") {
			$addtitle 		= "Manage option";
			$order_id		= $_REQUEST['order_id'];
			include(SITE_ADMIN_INCLUDES_PATH.'order-view.php');
		} else {
			$addtitle 		= "Manage Orders";
			include(SITE_ADMIN_INCLUDES_PATH.'order-list.php');
		}
	}
?>