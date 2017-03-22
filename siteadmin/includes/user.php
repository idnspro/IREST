<?php
$user_id = $_REQUEST['user_id'];

//form submission
$form_array = array();
$errorMsg 	= "no";

// Add a new user : Start here 
if($_POST['securityKey']==md5(ADDNEWUSER)){	
	if(trim($_POST['user_fname']) == '') {
		$form_array['user_fname_error'] = 'First Name required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['user_lname']) == '') {
		$form_array['user_lname_error'] = 'Last Name required';
		$errorMsg = 'yes';
	}
	
	if(trim($_POST['user_fname']) == trim($_POST['user_lname'])) {
		$form_array['user_fname_error'] = 'First & Last Name is same';
		$errorMsg = 'yes';
	}

	if(trim($_POST['user_email']) == '') {
		$form_array['user_email_error'] = 'Enter valid email address';
		$errorMsg = 'yes';
	} else {
		if(preg_match(EMAIL_ID_REG_EXP_PATTERN, $_POST['user_email'])) {
			// Check if email already exist
			if($usersObj->fun_checkEmailAddress($_POST['user_email']) === true) {
				$form_array['user_email_error'] = 'Email address already exists';
				$errorMsg = 'yes';
			}
		} else {
			$form_array['user_email_error'] = 'Enter valid email address';
			$errorMsg = 'yes';
		}
	}

	if(trim($_POST['user_pass']) == '') {
		$form_array['user_pass_error'] = 'Password required';
		$errorMsg = 'yes';
	}

	if((trim($_POST['user_pass']) == '') || (strlen($_POST['user_pass']) < 6)) {
		$form_array['user_pass_error'] = 'Minimum of 6 character password required';
		$errorMsg = 'yes';
	}

	if((trim($_POST['user_pass_confirm']) == '') || (trim($_POST['user_pass_confirm']) != trim($_POST['user_pass']))){
		$form_array['user_pass_error'] = 'confirm your password';
		$errorMsg = 'yes';
	}
   
	
	if($errorMsg == 'no' && $errorMsg != 'yes') {
		$user_fname		= $_POST['user_fname'];
		$user_lname		= $_POST['user_lname'];
		$user_email		= $_POST['user_email'];
		$user_login		= $_POST['user_login'];
		$user_pass 		= $_POST['user_pass'];
		
		// Step I: Add new User
	    $user_id 		= $usersObj->fun_addUser($user_login, $user_pass, $user_fname, $user_lname, $user_email);
		if(isset($_POST['user_type']) && $_POST['user_type'] == "manager") {
			$rest_id = $_POST['rest_id'];
			// Step II: check if manager, set is_manager = 1
			$usersObj->fun_updateUserAsManager($user_id);
			// Step III: assign restaurant if any
			if($restObj->fun_assignRestaurantToManager($rest_id, $user_id) > 0) {
				//$usersObj->sendAddRestaurantConfirmationEmailToManager($user_id, $rest_id);
		  }
		}
		
		$redirect_url 	= "admin-user.php?sec=edit&user_id=".$user_id;
		redirectURL($redirect_url);
	} else {
		$form_array['error_msg'] = "Please submit your form again!";
	}
	
	 $is_manager 	= $_POST['is_manager'];
	 if(isset($_POST['user_type']) && $_POST['user_type'] == "manager") {
		$rest_id = $_POST['rest_id'];
		// Step III: assign restaurant if any
		if($restObj->fun_assignRestaurantToManager($rest_id, $is_manager) > 0) {
	  }
	}	
}
// Add a new user : End here 

// Edit user : Start here 
if($_POST['securityKey']==md5(EDITUSER)){	
	if(trim($_POST['user_fname']) == '') {
		$form_array['user_fname_error'] = 'First Name required';
		$errorMsg = 'yes';
	}

	if(trim($_POST['user_lname']) == '') {
		$form_array['user_lname_error'] = 'Last Name required';
		$errorMsg = 'yes';
	}
	
	if(trim($_POST['user_fname']) == trim($_POST['user_lname'])) {
		$form_array['user_fname_error'] = 'First & Last Name is same';
		$errorMsg = 'yes';
	}

	if(trim($_POST['user_email']) == '') {
		$form_array['user_email_error'] = 'Enter valid email address';
		$errorMsg = 'yes';
	} else {
		if(preg_match(EMAIL_ID_REG_EXP_PATTERN, $_POST['user_email'])) {
			// Check if email already exist
		} else {
			$form_array['user_email_error'] = 'Enter valid email address';
			$errorMsg = 'yes';
		}
	}

	if($errorMsg == 'no' && $errorMsg != 'yes') {
		$user_id	= $_POST['user_id'];
		// Edit User
		$usersObj->fun_editUser($user_id);
		$redirect_url 	= "admin-user.php?sec=edit&user_id=".$user_id;

		redirectURL($redirect_url);
	} else {
		$form_array['error_msg'] = "Please submit your form again!";
	}	

}
// Edit user : End here 

// Add Restaurant Manager : Start here 
if($_POST['securityKey']==md5(ADDRESTMANAGER)){	
	if(trim($_POST['manager_id']) == '' || $_POST['manager_id'] == '0') {
		$form_array['manager_id_error'] = 'Manager required';
		$errorMsg = 'yes';
	}

	if($errorMsg == 'no' && $errorMsg != 'yes') {
		$rest_id		= $_POST['rest_id'];
		$manager_id		= $_POST['manager_id'];
		$back_url		= $_POST['back_url'];

		// assigning restaurant manager
		$restObj->fun_assignRestaurantToManager($rest_id, $manager_id);

		// Email Notification to restaurant manager

		$redirect_url	= base64_decode($back_url);
		redirectURL($redirect_url);
	} else {
		$form_array['error_msg'] = "Please submit your form again!";
	}	

}
// Add Restaurant Manager : End here 

if(isset($_GET['sec']) && $_GET['sec'] !="") {
	switch($_GET['sec']) {
		case "add":
		case "edit":
			require_once(SITE_ADMIN_INCLUDES_PATH.'user-form.php');
		break;
		case "manager":
			require_once(SITE_ADMIN_INCLUDES_PATH.'user-select-manager.php');
		break;
		case "notify":
			require_once(SITE_ADMIN_INCLUDES_PATH.'user-notify-manager.php');
		break;
		default:
			require_once(SITE_ADMIN_INCLUDES_PATH.'user-list.php');
	}
} else {
	require_once(SITE_ADMIN_INCLUDES_PATH.'user-list.php');
}
?>

