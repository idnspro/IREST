<?php
$desc_id = $_REQUEST['desc_id'];
//form submission
$form_array = array();
$errorMsg 	= "no";
// Add new Discount : Start here 
if($_POST['securityKey']==md5(ADDNEWDISCOUNT)){	
    if(trim($_POST['discount_name']) == '') {
		$form_array['discount_name_error'] = 'Discount Name required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['discount_value']) == '') {
		$form_array['discount_value_errorid'] = 'Discount value required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['discount_type']) == '') {
		$form_array['discount_value_errorid'] = 'Discount type required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['discount_min_amt']) == '') {
		$form_array['discount_min_amt_error'] = 'Min.Amounts required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['arrival_date']) == '') {
		$form_array['discount_start_date_errorid'] = 'Start Date required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['departure_date']) == '') {
		$form_array['discount_end_date_errorid'] = 'End Date required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['discount_comments']) == '') {
		$form_array['discount_comments_error'] = 'Discount Notes required';
		$errorMsg = 'yes';
	}
	if($errorMsg == 'no' && $errorMsg != 'yes') {
		$discount_name	     = $_POST['discount_name'];
		$discount_value	     = $_POST['discount_value'];
		$discount_type	     = $_POST['discount_type'];
		$discount_min_amt    = $_POST['discount_min_amt'];
		$discount_pre_tax    = $_POST['discount_pre_tax'];
		$discount_start_date = $_POST['arrival_date'];
		$discount_end_date	 = $_POST['departure_date'];
	    $discount_comments   = $_POST['discount_comments'];
		$Status              = $_POST['txtStatus'];
		
		$start_date     = date('Y-m-d', strtotime($discount_start_date));
		$end_date       = date('Y-m-d', strtotime($discount_end_date));
															
		$desc_id 		  = $restObj->fun_addDiscount($discount_name, $discount_value, $discount_type, $discount_min_amt, $discount_pre_tax, $start_date, $end_date, $discount_comments, $Status);
		$redirect_url 	  = "admin-restaurant-discount.php?sec=edit&desc_id=".$desc_id;
		redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}
}
// Add new Discount : End here 
if($_POST['securityKey']==md5(EDITDISCOUNT)){
if(trim($_POST['discount_name']) == '') {
		$form_array['discount_name_error'] = 'Discount Name required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['discount_value']) == '') {
		$form_array['discount_value_errorid'] = 'Discount value required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['discount_type']) == '') {
		$form_array['discount_value_errorid'] = 'Discount type required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['discount_min_amt']) == '') {
		$form_array['discount_min_amt_error'] = 'Min.Amounts required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['arrival_date']) == '') {
		$form_array['discount_start_date_errorid'] = 'Start Date required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['departure_date']) == '') {
		$form_array['discount_end_date_errorid'] = 'End Date required';
		$errorMsg = 'yes';
	}
	if(trim($_POST['discount_comments']) == '') {
		$form_array['discount_comments_error'] = 'Discount Notes required';
		$errorMsg = 'yes';
	}
	if($errorMsg == 'no' && $errorMsg != 'yes') {
	
		$restObj->fun_editdiscount($desc_id);
		$redirect_url 	= "admin-restaurant-discount.php?sec=edit&subsec=det&desc_id=".$desc_id;
		redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}	
}

if(isset($_GET['sec']) && $_GET['sec'] !="") {
	switch($_GET['sec']) {
		case "add":
		case "edit":
			require_once(SITE_ADMIN_INCLUDES_PATH.'discount-form.php');
		break;
		default:
			require_once(SITE_ADMIN_INCLUDES_PATH.'discount-list.php');
	}
  } else {
      require_once(SITE_ADMIN_INCLUDES_PATH.'discount-list.php');
}
?>