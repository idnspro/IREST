<?php
	$rest_id 	= $_REQUEST['rest_id'];
	if(isset($_REQUEST['booking_id']) && $_REQUEST['booking_id'] !=""){
		$booking_id 	= $_REQUEST['booking_id'];
	} else {
		/*
		if(!isset($rest_id) || $rest_id == ""){ // if restaurant id is not available then redirect to book list page
			$redirect_url 	= "admin-book.php";
			redirectURL($redirect_url);
		}
		*/
		$booking_id 			= "";
	}

	// Form submission
	$form_array = array();
	$errorMsg 	= 'no';
	if($_POST['securityKey']==md5("RESTAURANTBOOKING")) {
		if(trim($_POST['user_fname']) == '') {
			$form_array['user_fname_error'] = 'First Name required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['user_lname']) == '') {		
			$form_array['user_lname_error'] = 'Last Name required';
			$errorMsg = 'yes';
		}
		if($_POST['user_email'] == '') {
			$form_array['user_email_error'] = 'Please enter a valid email address';
			$errorMsg = 'yes';
		}
		if(trim($_POST['phone']) == '') {		
			$form_array['phone_error'] = 'Phone required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['schedule']) == '') {		
			$form_array['schedule_error'] = 'Date & Time required';
			$errorMsg = 'yes';
		}
		if(trim($_POST['total_bookings']) == '') {		
			$form_array['total_bookings_error'] = 'Number in party required';
			$errorMsg = 'yes';
		}

		if($errorMsg == 'no' && $errorMsg != 'yes') {
			// add booking
			$user_fname 	= trim($_POST['user_fname']);
			$user_lname 	= trim($_POST['user_lname']);
			$user_email 	= trim($_POST['user_email']);
			$phone 			= trim($_POST['phone']);
			$schedule 		= $_POST['schedule'];
			$total_bookings	= trim($_POST['total_bookings']);
			$instructions 	= trim($_POST['instructions']);
			$total_amount 	= $_POST['total_amount'];
			$currency_id 	= $_POST['currency_id'];
			$pay_method 	= $_POST['pay_method'];
			$payment_status = $_POST['payment_status'];
			$status 		= $_POST['status'];
			$active 		= $_POST['active'];
			if(isset($user_id) && $user_id != "") {
				// update user details, first name, last name, email id
				$usersObj->fun_updateUserNameEmail($user_id, $user_fname, $user_lname, $user_email);
			} else {
				// verify email id, if match then update first name, last name and return user_id
				if($usersObj->fun_checkEmailAddress($user_email) === true) {
					$user_id 	= $dbObj->getField(TABLE_USERS, "user_email", $user_email, "user_id");
					$usersObj->fun_updateUserNameEmail($user_id, $user_fname, $user_lname, $user_email);
				} else {
				// if email not matched, add new user
					$user_pass 	= md5('anonymous');
					$user_id	= $usersObj->fun_registerUser($user_email, $user_pass, $user_fname, $user_lname, $user_email, "", "", "", "", "", "", "", "", "0");
				}
			}

			if(isset($_REQUEST['booking_id']) && $_REQUEST['booking_id'] != "") { 
				//update exiting booking
				$booking_id = $restObj->fun_addBookTable($_REQUEST['booking_id'], $user_id, $rest_id, $phone, $total_bookings, $schedule, $instructions, $total_amount, $currency_id, $pay_method, $payment_status, $status, $active);
			} else {
				// new entry
				$booking_id = $restObj->fun_addBookTable("", $user_id, $rest_id, $phone, $total_bookings, $schedule, $instructions, $total_amount, $currency_id, $pay_method, $payment_status, $status, $active);
			}

			//add / update  user enquiry relation
			$restObj->fun_addUserBookingRelation($booking_id, $user_id, "0");
			$redirect_url 	= "admin-book.php?sec=edit&booking_id=".$booking_id."&rest_id=".$rest_id;
			redirectURL($redirect_url);
		} else {
			$form_array['error_msg'] = "Please submit your form again!";
		}
	}

	if(isset($_GET['sec']) && $_GET['sec'] !="") {
		switch($_GET['sec']) {
			case "add":
			case "edit":
				require_once(SITE_ADMIN_INCLUDES_PATH.'book-form.php');
			break;
			default:
				require_once(SITE_ADMIN_INCLUDES_PATH.'book-list.php');
		}
	} else {
		require_once(SITE_ADMIN_INCLUDES_PATH.'book-list.php');
	}
?>