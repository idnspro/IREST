<?php
  	$rest_id   	= $_REQUEST['rest_id'];
  	$coupon_id  = $_REQUEST['coupon_id'];

	//form submission
	$form_array = array();
	$errorMsg 	= "no";

	// Add new restaurant submit : Start here 
	if($_POST['securityKey']==md5("ADDCOUPON")){	
		if(trim($_POST['coupon_name']) == '') {
			$form_array['coupon_name_error'] = 'Coupon name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['coupon_code']) == '') {
			$form_array['coupon_code_error'] = 'Coupon code required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['coupon_discount']) == '') {
			$form_array['coupon_discount_error'] = 'Coupon discount required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['coupon_desc']) == '') {
			$form_array['coupon_desc_error'] = 'Coupon discription required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$rest_id 				= $_POST['rest_id'];
			$coupon_name			= $_POST['coupon_name'];
			$coupon_type 			= $_POST['coupon_type'];
            $coupon_auto_distributed= $_POST['coupon_auto_distributed'];
            $coupon_code			= $_POST['coupon_code'];
			$coupon_discount		= $_POST['coupon_discount'];
			$coupon_discount_type	= $_POST['coupon_discount_type'];
			$coupon_pre_tax 		= $_POST['coupon_pre_tax'];
			$coupon_start_date		= $_POST['coupon_start_date'];
			$coupon_end_date 		= $_POST['coupon_end_date'];
			$coupon_duration 		= $_POST['coupon_duration'];
			$coupon_duration_type	= $_POST['coupon_duration_type'];
			$coupon_loyalty 		= $_POST['coupon_loyalty'];
			$coupon_loyalty_type	= $_POST['coupon_loyalty_type'];
			$coupon_takeup			= $_POST['coupon_takeup'];
			$coupon_desc			= $_POST['coupon_desc'];
			$status					= $_POST['status'];
			$back_url				= $_POST['back_url'];
			// Add New Coupon 
			$coupon_id 			= $restObj->fun_addCoupon($rest_id, $coupon_name, $coupon_type, $coupon_auto_distributed, $coupon_code, $coupon_discount, $coupon_discount_type, $coupon_pre_tax, $coupon_start_date, $coupon_end_date, $coupon_duration, $coupon_duration_type, $coupon_loyalty, $coupon_loyalty_type, $coupon_takeup, $coupon_desc, $status);
			$redirect_url 		= "admin-restaurant-coupons.php?sec=edit&coupon_id=".$coupon_id."&rest_id=".$rest_id."&back_url=".$back_url;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}

	// Add new restaurant submit : End here 
	// Edit restaurant details submit : Start here 
	if($_POST['securityKey']==md5("EDITCOUPON")){	
		if(trim($_POST['coupon_name']) == '') {
			$form_array['coupon_name_error'] = 'coupon name required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['coupon_code']) == '') {
			$form_array['coupon_code_error'] = 'coupon Code required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['coupon_discount']) == '') {
			$form_array['coupon_discount_error'] = 'coupon Discount required';
			$errorMsg = 'yes';
		}

		if(trim($_POST['coupon_desc']) == '') {
			$form_array['coupon_desc_error'] = 'coupon Discription required';
			$errorMsg = 'yes';
		}

	   if($errorMsg == 'no' && $errorMsg != 'yes') {
			$rest_id 				= $_POST['rest_id'];
			$coupon_name			= $_POST['coupon_name'];
			$coupon_id 				= $_POST['coupon_id'];
            $coupon_code			= $_POST['coupon_code'];
			$coupon_type 			= $_POST['coupon_type'];
			$coupon_discount		= $_POST['coupon_discount'];
			$coupon_discount_type	= $_POST['coupon_discount_type'];
			$coupon_start_date		= $_POST['coupon_start_date'];
			$coupon_end_date 		= $_POST['coupon_end_date'];
			$coupon_duration 		= $_POST['coupon_duration'];
			$coupon_pre_tax 		= $_POST['coupon_pre_tax'];
			$coupon_takeup			= $_POST['coupon_takeup'];
			$coupon_desc			= $_POST['coupon_desc'];
			$status					= $_POST['status'];
			$back_url				= $_POST['back_url'];
			// Edit Restaurant 
			$restObj->fun_editcoupon($coupon_id);
			$redirect_url 		= "admin-restaurant-coupons.php?sec=edit&coupon_id=".$coupon_id."&rest_id=".$rest_id."&back_url=".$back_url;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
	}

	// Edit restaurant details submit : End here 

	if(isset($_GET['sec']) && $_GET['sec'] !="") {
		switch($_GET['sec']) {
			case "add":
			case "edit":
				require_once(SITE_ADMIN_INCLUDES_PATH.'coupons-form.php');
			break;
			default:
				require_once(SITE_ADMIN_INCLUDES_PATH.'coupons-list.php');
		}
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'coupons-list.php');
	}
?>